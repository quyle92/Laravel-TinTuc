<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use View;

class LoaiTinController extends Controller
{
    public function getDanhsach() 
    {
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.danhsach',['loaitin' => $loaitin]);
    }

    public function getThem()
    {
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.them',['theloai' => $theloai]);

    }

    public function postThem(Request $request)
    {
    	$this->validate($request,[
    		'TheLoai' => 'required',
    		'Ten' => 'required|min:3|max:30|unique:LoaiTin,Ten'
    	],[
    		'TheLoai.required' => 'Category name is required!',
    		'Ten.required' => 'Subcategory name is required!',
    		'Ten.min' => 'Minimum character length is 3',
    		'Ten.max' => 'Maximum character length is 30',
    		'Ten.unique' =>'Name must be unique!',
    	]);

    	$loaitin = new LoaiTin;
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = str_slug($loaitin->Ten);
    	$loaitin->idTheLoai = $request->TheLoai;
    	$loaitin->save();

    	return redirect()->back()->with('success','Added successfully');

    }

    public function getSua($id)
    {
    	$loaitin = LoaiTin::find($id);
    	$theloai = TheLoai::all();
    	$data = [
			'loaitin' => $loaitin, 
			'theloai' => $theloai
    	];
    	return view('admin.loaitin.sua',$data);
    	//return View::make('admin.loaitin.sua')->with($data);
    }

    public function postSua(Request $request, $id)
    {
    	$this->validate($request,[
    		'TheLoai' => 'required',
    		'Ten' => 'required|min:3|max:20|unique:LoaiTin,Ten'
    	],[
    		'TheLoai.required' => 'Category name is required!',
    		'Ten.required' => 'Subcategory name is required!',
    		'Ten.min' => 'Minimum character length is 3',
    		'Ten.max' => 'Maximum character length is 20',
    		'Ten.unique' =>'Name must be unique!',
    	]);

    	$loaitin = new LoaiTin;
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = str_slug($loaitin->Ten);
    	$loaitin->idTheLoai = $request->TheLoai;
    	$loaitin->save();

    	return redirect()->back()->with('success','Added successfully')->withInput();
    }

    public function getXoa($id)
    {
    	$loaitin = LoaiTin::find($id);
    	$loaitin->LoaiTintoTinTuc()->delete();
        $loaitin->delete();

    	return redirect()->back()->with('success','Removed successfully');
    }
}
