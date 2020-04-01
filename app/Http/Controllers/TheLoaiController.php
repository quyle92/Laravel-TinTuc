<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
//use Validator, Input, Redirect; 
//use Session;




class TheLoaiController extends Controller
{
    public function getDanhsach()
    {	
    	$theloai = TheLoai::where('id','>=', 1)->orderBy('id','asc')->get();
    	return view('admin.theloai.danhsach',['theloai' => $theloai]);
    }

    public function getThem()
    {
    	return view('admin.theloai.them');
    }

    public function postThem(Request $request)
    {
    	/** Cách 1 **/
    	// $this->validate($request,
    	// 	['Ten' => 'required|min:3|max:100'],
    	// 	[
    	// 		'Ten.required' => 'Pls enter Category Title',
    	// 		'Ten.min' => 'Min characters are 3!',
    	// 		'Ten.max' => 'Max characters are 100'
    	// 	]
    	// );

    	/** Cách 2 **/
    	$rules = array ('Ten' => 'required|min:3|max:10');
    	$errorMessages = array (
    		    'Ten.required' => 'Pls enter Category Title',
    			'Ten.min' => 'Min characters are 3!',
    			'Ten.max' => 'Max characters are 100'
    	);
    	$validator = \Validator::make($request->all(), $rules, $errorMessages);//if not declare "use Validator, Input, Redirect;"" at the top of this page, prefix \ before Validator:: class

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	}


    	$theloai = new TheLoai;
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = str_slug($request->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/them')->with('thongbao','thêm thành công');
    }

    public function getSua($id)
    {	
    	$theloai = TheLoai::find($id);
    	return view('admin.theloai.sua',['theloai' => $theloai]);
    }

    public function postSua (Request $request, $id)
    {	
    	$theloai= TheLoai::find($id);
    	$rules= array('Ten' => 'required|min:3|max:100|unique:TheLoai,Ten');
 		$errorMessages = array (
 			'Ten.required' => 'Pls enter Category Title',
 			'Ten.min' => 'Min characters are 3!',
 			'Ten.max' => 'Max characters are 10',
 			'Ten.unique' => 'Duplicate category title'
 		);

 		$validator = \Validator::make($request->all(), $rules, $errorMessages);

 		if ($validator->fails()){
 			return redirect()->back()->withErrors($validator)->withInput();
 		}

 		$theloai = TheLoai::find($id);
 		$theloai->Ten = $request->Ten;
 		$theloai->TenKhongDau = str_slug($theloai->Ten);
 		$theloai->save();
 		
 		return redirect('admin/theloai/sua/'.$id)->with('thongbao','Edit successfully');
 	}

 	public function getXoa($id) 
 	{
 		$theloai = TheLoai::find($id);
 		$theloai->delete();

 		return redirect()->back()->with('thongbao','Remove successfully');;
 	}
}
