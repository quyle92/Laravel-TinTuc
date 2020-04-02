<?php
namespace App\Http\Controllers;
use App\Loaitin;
use App\Mail\WelcomeMail;
use App\Slide;
use App\TheLoai;
use App\TinTuc;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;//include it
class PagesController extends Controller
{   
    public function __construct()
    {
        $theloai = TheLoai::all();
        \View:: share('theloai',$theloai);// use "use View;" at top or put "\" before View::, otherwise error thrown "Class App/Http/Controllers/View Not Found error"
        $slide = Slide::all();
        \View:: share('slide',$slide);
    }
    public function home()
    {   
        //$theloai = TheLoai::all();
        //$tintuc = TinTuc::where('id',"<=",5)->get();
        return view('pages.home');
    }
    public function contact()
    {    
        //$theloai = TheLoai::all();
        return view('pages.contact');
    }
    public function loaitin($id)
    {
        $loaitin = Loaitin::find($id);
        $tintuc=$loaitin->LoaitintoTinTuc()->paginate (5);
        //$tintuc=$loaitin->LoaitintoTinTuc->paginate (15);this will throw out error:"Method paginate does not exist." as $loaitin->LoaitintoTinTuc used for iterating over foreach loop to access property of model.
        //Cách 2: $tintuc = TinTuc::where('idLoaiTin',$id)->paginate (15);
        return view('pages.loaitin',['loaitin' => $loaitin,'tintuc' => $tintuc]);
    }
    public function tintuc($id)
    {
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat',1)->take(5)->get();
        //cách 1:
        $id_loaitin = $tintuc->TinTuctoLoaiTin->id;
        $tinlienquan = TinTuc::where([
            ['idLoaiTin',$id_loaitin],
            ['id','!=',$id]
        ])->orderBy('created_at', 'desc')->take(5)->get();
        //cách 2:
         //$tinlienquan = tintuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(5)->get();
        $comment = $tintuc->TinTuctoComment->all();
        //$user = $tintuc->TinTuctoComment->CommenttoUser->all();
        return view('pages.tintuc',compact('tintuc','tinnoibat','tinlienquan','comment'));
    }

    public function getDangNhap()
    {
        return view('pages.login');
    }

    public function postDangNhap(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'email is required',
                'password.required' => 'Password is required'
            ]);
        $userdata = array(
            'email' => $request->email,
            'password' => $request->password
        );
        if(\Auth::attempt($userdata))
        {
            return view('pages.home');
        }
        else
        {
            return redirect('/login')->withInput()->with('thongbao','Wrong email or password');
        }
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('/login');
    }

    public function userSettings()
    {
        return view('pages.user');
    }

    public function postuserSettings(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
           // 'email' => 'required',
        ],[
            'name.required' => 'Name is required',
            //'email.required' => 'Email is required'
        ]);

        $user = Auth::user();// vì người dùng đang trong trạng thái đăng nhập nên khi dùng "Auth::user()" Laravel biết đc info của người đó nằm trong model nào, record id bao nhiêu mà ko cần phải dùng "$user = User::find($id)"
        echo $user->name = $request->name;
        //$user->email = $request->email;//Email field on user.blade is disabled so don't include it here, otherwise validation message will be thrown out.
        if($request->changePassword == "on")
        { 
            $this->validate($request,[
            'password' => 'required',
            'passwordAgain' => 'required|same:password',
        ],[
            'password.required' => 'password is blank!',
            'passwordAgain.required' => 'passwordAgain is blank!',
            'passwordAgain.same' => 'passwordAgain is not the same'
        ]);

            echo $user->password = bcrypt($request->password);
            if(Auth::user()->password == $user->password)
            return redirect()->back()->with('message',"New password is same as current password");
           
        }

        $user->save();

       return redirect()->back()->with('success',"Update success!");

    }

    public function getRegister()
    {
        return view('pages.register');
    }

    public function postRegister(Request $request)
    {
          $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'passwordAgain' => 'required|same:password',
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => "Email is wrong format",
            'email.unique' => 'email is duplicate!',
            'password.required' => 'password is blank!',
            'passwordAgain.required' => 'passwordAgain is blank!',
            'passwordAgain.same' => 'passwordAgain is not the same'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen =0;

        $user->save();
      //  Auth::login($user, true);
        $user->id;
        
        //$user = Auth::user();
        Mail::to($user->email)->send(new WelcomeMail($user));
        $this->getXoa($user->id);
       return redirect()->back()->with('success',"Register success!");
    }

    public function getXoa($id) 
    {
        $user = User::find($id);
        //$comment= Comment::where('id', $id)->where('idUser',$user_id)->get();
        $user->delete();
        return redirect()->back()->with('success',"Register success!");
    }

    public function search(Request $request)
    {   
        DB::enableQueryLog();// enable the query log, phải để trc câu lệnh DB::, ko thì dd(DB::getQueryLog());sẽ ko chạy 

        $term = $request->term;
        $tintuc = 
        DB::select(
            'SELECT * FROM tintuc where 
            -- BINARY TieuDe LIKE :tieude or
            BINARY TieuDe REGEXP :tieude',////BINARY is to convert words into binary so that it becomes "diacritic match"
            [
                //'tieude' => '%'. $term . '%',
                //'tomtat' => '%'. $term . '%',
                'tieude' =>  "[[:<:]]" . $term . '[[:>:]]'//this is match exact word, [[:>:]] is word boundary
            ]
        );//dùng BINARY vì ở đây search string với UTF-8, ko sẽ ra cả những chữ ko dấu tương tự (https://kipalog.com/posts/Cach-tim-kiem-co-dau-tren-Mysql---Search-utf8-on-Mysql)

        // dd(DB::getQueryLog());// view the query log(arg)

        
        foreach($tintuc as $tt)
        {
            echo $tt->TieuDe.'<br>';
            echo $tt->TomTat."<hr>";
        }
    }

}