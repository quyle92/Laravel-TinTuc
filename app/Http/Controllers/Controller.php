<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

//use Auth; //I added it

class Controller extends BaseController 
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests; 

    // function __construct()
    // {
    // 	$this->DangNhap();
    // }

    // function DangNhap()
    // {
    // 	if(Auth::check())
    // 	{
    // 		View::share('user_login',Auth::user());
    // 		// View::composer('*', function($view){
    // 		// 	$view->with('user_login', Auth::user());
    // 		// });
    // 	}
    // }
}
