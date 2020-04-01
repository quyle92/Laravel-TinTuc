<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function getXoa($id, $idTinTuc)
    {
    	$commment = Comment::find($id);
    	$commment->delete();

    	return redirect('admin/tintuc/sua/'.$idTinTuc)->with('comment_remove', 'Comment removed!');
    }

    public function postComment(Request $request, $id_tintuc, $id_user)
    {    	
    	$this->validate($request,[
    		'NoiDung' => 'required'
    	],
    	[
    		'NoiDung.required' => 'NoiDung is required!'
    	]);

    	$commment = new Comment;
    	$commment->NoiDung = $request->NoiDung;
    	$commment->idTinTuc = $id_tintuc; 
    	$commment->idUser =$id_user;//OR $commment->idUser = \Auth::id();

    	$commment->save();

    	return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
