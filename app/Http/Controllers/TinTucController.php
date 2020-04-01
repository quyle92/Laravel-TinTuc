<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use Input;


class TinTucController extends Controller
{
    public function getDanhsach()
    {
    	$tintuc = TinTuc::where('id','>',995)->orwhere('id', 19)->orderBy('id','asc')->get();
    	return view('admin/tintuc/danhsach',['tintuc'=>$tintuc]);
    }

    public function getThem()
    {	
    	$theloai = TheLoai::all();
    	$loaitin = Loaitin::all();
		return view('admin/tintuc/them',['theloai'=>$theloai , 'loaitin'=>$loaitin]);    	
    }

    public function postThem(Request $request)
    {
    	$this->validate($request,[
    		'TheLoai' => 'required',
    		'LoaiTin' => 'required',
    		'TieuDe' => 'required',
    		'TomTat' => 'required',
    		'NoiDung' => 'required',

    	],[
    		'TheLoai.required' => 'Category is blank!',
    		'LoaiTin.required' => 'Sub-Category is blank!',
    		'TieuDe.required' => 'Title is blank!',
    		'TomTat.required' => 'Summary is blank!',
    		'NoiDung.required' => 'Content is blank!',
    	]);

    	$tintucThem = new TinTuc;
    	$tintucThem->TieuDe = $request->TieuDe;
    	$tintucThem->TieuDeKhongDau = str_slug($tintucThem->TieuDe);
    	$tintucThem->TomTat = $request->TomTat;
    	$tintucThem->NoiDung = $request->NoiDung;

    	if ($request->hasFile('Hinh'))
    	{	
    		$file = $request->file('Hinh');
    		$imgMime= $file->getClientOriginalExtension();
    		if($imgMime != 'image/jpeg' && $imgMime != 'image/png' && $imgMime !='image/jpg')
    		{
    			return redirect()->back()->with('img_error','Image file is not valid!');
    		}
	    	$destinationPath = 'upload/tintuc';
	    	$fname = str_random(4)."_".$file->getClientOriginalName();
	    	while(file_exists('upload/tintuc/'.$fname))
	    	{
	    		$fname = str_random(4)."_".$file->getClientOriginalName();
	    	}
    		$file->move($destinationPath, $fname);
    		$tintucThem->Hinh = $fname;
    	} 
    	
    	$tintucThem->NoiBat = $request->NoiBat;
    	$tintucThem->idLoaiTin = $request->LoaiTin;
    	$tintucThem->save();

		$tintuc = TinTuc::where('id','>=',1000)->orderBy('id','asc')->get();
    	return view('admin/tintuc/danhsach',['tintuc' => $tintuc]);
    	
    }

    public function getSua($id)
    {
    	$tintuc = TinTuc::find($id);
    	$theloai = TheLoai::all();
    	return view('admin/tintuc/sua',['tintuc' => $tintuc, "theloai" => $theloai]);
    }


    public function postSua(Request $request, $id)
    {
    	$this->validate($request,[
    		'TheLoai' => 'required',
    		'LoaiTin' => 'required',
    		'TieuDe' => 'required',
    		'TomTat' => 'required',
    		'NoiDung' => 'required',
    		'Hinh' => 'image|mimes:jpg,jpeg,png'
    	],[
    		'TheLoai.required' => 'Category is blank!',
    		'LoaiTin.required' => 'Sub-Category is blank!',
    		'TieuDe.required' => 'Title is blank!',
    		'TomTat.required' => 'Summary is blank!',
    		'NoiDung.required' => 'Content is blank!',
    		'Hinh.image' => 'Not a valid image',
    		'Hinh.mimes' => 'Not a valid mime type'.' Yours is '.  $request->file('Hinh')->getMimeType()
    	]);

    	$tintuc = TinTuc::find($id);
    	$tintuc->TieuDe = $request->TieuDe;
    	$tintuc->TieuDeKhongDau = str_slug($tintuc->TieuDe);
    	$tintuc->TomTat = $request->TomTat;
    	$tintuc->NoiDung = $request->NoiDung;

    	if($request->hasFile('Hinh'))
    	{
    		$file = $request->file('Hinh');
    		//$imgExtention = $file->getClientOriginalExtension();
    		// if ($imgExtention !="JPG" && $imgExtention !="png" && $imgExtention !="JPEG")
    		// {
    		// 	return redirect()->back()->with('img_error','Img Extension is not valid!'.$imgExtention )->withInput();
    		// }
    		// $fname = str_random(4)."_".$file->getClientOriginalName();
    		While(file_exists($fname))
    		{
    			$fname = str_random(4)."_".$file->getClientOriginalName();
    		}

    		$file->move('upload/tintuc',$fname);
    		$tintuc->Hinh = $fname;

    	}

    	$tintuc->NoiBat = $request->NoiBat;
    	$tintuc->idLoaiTin = $request->LoaiTin;
    	$tintuc->save();

    	return redirect()->route('danhsach-tintuc');
    }

    public function getXoa($id) 
    {
    	$tintuc = TinTuc::findOrFail($id);
    	$tintuc->TinTuctoComment()->delete();
        $tintuc->delete();

    	return redirect('admin/tintuc/danhsach');
    }

}

