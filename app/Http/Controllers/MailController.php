<?php

namespace App\Http\Controllers;
use Mail;
use App\Mail\WelcomeMail;//include it
use Auth;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function send()
    {
    	// Mail::send(['text'=>'welcome'],['name'=>'Steven.Ng.MMO'], function($message){
    	// 	$message->to('free2idol@gmail.com','Quy')->subject('Hello Quy from Steven.Ng.MMO');
    	// 	$message->from('steven.ng.mmo@gmail.com','Steven.Ng.MMO');
    	// });
    	$user = Auth::user();
    	Mail::to($user->email)->send(new WelcomeMail($user));
    	
    }
}
