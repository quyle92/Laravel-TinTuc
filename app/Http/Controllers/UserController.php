<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use Input;
use Illuminate\Support\Facades\Auth;// or use Auth;

class UserController extends Controller
{
    public function getDanhsach()
    {
    	$user = User::all();
    	return view('admin/user/danhsach',['user'=>$user]);
    }

    public function getThem()
    {	
    	return view('admin/user/them');    	
    }

    public function postThem(Request $request)
    {
    	$this->validate($request,[
    		'name' => 'required',
    		'email' => 'required|email|unique:users,email',
    		'password' => 'required',
    		'passwordAgain' => 'required|same:password',
    		

    	],[
    		'name.required' => 'name is blank!',
            'email.required' => 'email is blank!',
            'email.email' => 'email format is wromg!',
            'email.unique' => 'email is duplicate!',
            'password.required' => 'password is blank!',
            'passwordAgain.required' => 'passwordAgain is blank!',
            'passwordAgain.same' => 'passwordAgain is not the same'
    	]);

    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
        $user->quyen = $request->quyen;

    	$user->save();

		return redirect('admin/user/danhsach');

    	
    }

    public function getSua($id)
    {
    	$user = User::find($id);
    	return view('admin.user.sua',['user' => $user]);
    }


    public function postSua(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
           // 'email' => 'required|email'

        ],[
            'name.required' => 'name is blank!',
           // 'email.required' => 'email is blank!',
            //'email.email' => 'email format is wromg!',
           

        ]);

        $user = User::find($id);
        $user->name = $request->name;
       // $user->email = $request->email;
       
        $user->quyen = $request->quyen;

        if ($request->changePassword == "on")
        {//echo 111;//
            $this->validate($request,[

            'password' => 'required',
            'passwordAgain' => 'required|same:password',
            

        ],[

            'password.required' => 'password is blank!',
            'passwordAgain.required' => 'passwordAgain is blank!',
            'passwordAgain.same' => 'passwordAgain is not the same'
        ]);
             $user->password = bcrypt($request->password);
        }
       $user->save();

       return redirect('admin/user/danhsach');


    }

    public function getXoa($id) 
    {
        $user = User::find($id);
        //$comment= Comment::where('id', $id)->where('idUser',$user_id)->get();
        $user->delete();
    	return redirect('admin/user/danhsach');
    }

    public function getDangNhap()
    {
        return view('admin.login');
    }

    public function postDangNhap(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ],[
            'name.required' => 'name is blank!',
            'password.required' => 'The password field is required.'
        ]); 

        $userdata = array(
            'email' => $request->email,
            'password' => $request->password
        );

        if(Auth::attempt($userdata))
        {
              return redirect('admin/user/danhsach');
        }
        else 
        {
            return redirect('admin/login')->withInput()->with('thongbao','Wrong email or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}

