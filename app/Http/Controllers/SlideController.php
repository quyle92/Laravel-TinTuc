<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use Input;

class SlideController extends Controller
{
    public function getDanhsach()
    {
    	$slide = Slide::all();
    	return view('admin/slide/danhsach',['slide'=>$slide]);
    }

    public function getThem()
    {	
    	return view('admin/slide/them');    	
    }

    public function postThem(Request $request)
    {
    	$this->validate($request,[
    		'Ten' => 'required',
    		'NoiDung' => 'required',
    		'link' => 'required',
    		'Hinh' => 'required',
    		

    	],[
    		'NoiDung.required' => 'Content is blank!',
            'Ten.required' => 'Ten is blank!',
            'link.required' => 'link is blank!',
            'Hinh.required' => 'Hinh is blank!',
    	]);

    	$slide = new Slide;
    	$slide->Ten = $request->Ten;
    	$slide->NoiDung = $request->NoiDung;
    	$slide->link = $request->link;

    	if ($request->hasFile('Hinh'))
    	{	
    		$file = $request->file('Hinh');
    		$imgMime= $file->getMimeType();
    		if($imgMime != 'image/jpeg' && $imgMime != 'image/png' && $imgMime !='image/jpg')
    		{
    			return redirect()->back()->with('img_error','Image file is not valid! '.$imgMime);
    		}
	    	$destinationPath = 'upload/slide';
	    	$fname = str_random(4)."_".$file->getClientOriginalName();
	    	while(file_exists('upload/slide/'.$fname))
	    	{
	    		$fname = str_random(4)."_".$file->getClientOriginalName();
	    	}
    		$file->move($destinationPath, $fname);
    		$slide->Hinh = $fname;
    	} 
    	
    	$slide->save();

		return redirect('admin/slide/danhsach');

    	
    }

    public function getSua($id)
    {
    	$slide = slide::find($id);
    	return view('admin/slide/sua',['slide' => $slide]);
    }


    public function postSua(Request $request, $id)
    {
    	$this->validate($request,[
            'Ten' => 'required',
            'NoiDung' => 'required',
            'link' => 'required',
            'Hinh' => 'required',
            

        ],[
            'NoiDung.required' => 'Content is blank!',
            'Ten.required' => 'Ten is blank!',
            'link.required' => 'link is blank!',
            'Hinh.required' => 'Hinh is blank!',
    	]);

    	$slide = Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        $slide->link = $request->link;

        if ($request->hasFile('Hinh'))
        {   
            $file = $request->file('Hinh');
            $imgMime= $file->getMimeType();
            if($imgMime != 'image/jpeg' && $imgMime != 'image/png' && $imgMime !='image/jpg')
            {
                return redirect()->back()->with('img_error','Image file is not valid! '.$imgMime);
            }
            $destinationPath = 'upload/slide';
            $fname = str_random(4)."_".$file->getClientOriginalName();
            while(file_exists('upload/slide/'.$fname))
            {
                $fname = str_random(4)."_".$file->getClientOriginalName();
            }
            $file->move($destinationPath, $fname);
            $slide->Hinh = $fname;
        } 
        
        $slide->save();

        return redirect('admin/slide/danhsach');

    }

    public function getXoa($id) 
    {
    	$slide = slide::find($id);
    	$slide->delete();

    	return redirect('admin/slide/danhsach');
    }

}

