<?php
use App\Mail\WelcomeMail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaDed by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('email', 'MailController@send');
Route::get('email-template', function(){
	return new WelcomeMail();
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('theloai', function() {
	$theloai = App\TheLoai::find(1)->TheLoaitoLoaiTin()->get();
	//or :$theloai = App\TheLoai::find(1)->TheLoaitoLoaiTin;
	foreach ($theloai as $t)
	{
		echo $t->Ten."<br>";

	}
});

Route::get('theloai-danhsach', function(){
	return view('admin.theloai.sua');
});


Route::group(['prefix' => 'admin','middleware' => 'AdminLoginMiddleware'], function(){
	Route::group(['prefix' => 'theloai'], function(){
		Route::get('danhsach','TheLoaiController@getDanhsach');

		Route::get('them','TheLoaiController@getThem');
		Route::post('them','TheLoaiController@postThem');

		Route::get('sua/{id}','TheLoaiController@getSua');
		Route::post('sua/{id}','TheLoaiController@postSua')->name('admin/theloai/sua');

		Route::get('xoa/{id}','TheLoaiController@getXoa');
	});

	Route::group(['prefix' => 'loaitin'], function(){
		Route::get('danhsach','LoaiTinController@getDanhsach');

		Route::get('them','LoaiTinController@getThem');
		Route::post('them','LoaiTinController@postThem');

		Route::get('sua/{id}','LoaiTinController@getSua');
		Route::post('sua/{id}','LoaiTinController@postSua');

		Route::get('xoa/{id}','LoaiTinController@getXoa');
	});

	Route::group(['prefix' => 'tintuc'], function(){
		Route::get('danhsach','TinTucController@getDanhsach')->name('danhsach-tintuc');

		Route::get('them','TinTucController@getThem');
		Route::post('them','TinTucController@postThem');

		Route::get('sua/{id}','TinTucController@getSua');
		Route::post('sua/{id}','TinTucController@postSua');

		Route::get('xoa/{id}','TinTucController@getXoa');
	});

	Route::group(['prefix' => 'comment'], function(){
		Route::get('xoa/{id}/{idTinTuc}','CommentController@getXoa');
	});

	Route::group(['prefix' => 'slide'], function(){
		Route::get('danhsach','SlideController@getDanhsach');

		Route::get('them','SlideController@getThem');
		Route::post('them','SlideController@postThem');

		Route::get('sua/{id}','SlideController@getSua');
		Route::post('sua/{id}','SlideController@postSua');

		Route::get('xoa/{id}','SlideController@getXoa');
	});

	Route::group(['prefix' => 'user'], function(){
		Route::get('danhsach','UserController@getDanhsach');

		Route::get('them','UserController@getThem');
		Route::post('them','UserController@postThem');

		Route::get('sua/{id}','UserController@getSua');
		Route::post('sua/{id}','UserController@postSua');

		Route::get('xoa/{id}','UserController@getXoa');
	});

	Route::group(['prefix'=>'ajax'], function(){
		Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
	});
});//->middleware('AdminLoginMiddleware');


Route::get('admin/login', 'UserController@getDangNhap');
Route::post('admin/login', 'UserController@postDangNhap');
Route::get('admin/logout', 'UserController@logout');

/**
 * Tự làm - Soft Delete
 * 1: php artisan make:migration add_deleted_at_column_to_users_table --table=users
 * 2: on User.php Model: use Illuminate\Database\Eloquent\SoftDeletes; at top use SoftDeletes; within class
 * 3: php artisan migrate
 * 4: go to phpmyadmin and check if "deleted_at" col is created
 */

Route::get('insert', function(){
	$user = new App\User();
	$user->name ="testuser";
	$user->email ="test11@gmail.com";
	$user->password =bcrypt(123);
	$user->quyen = 1;

	$user->save();
});
//Retrieving  Soft Deleted Models
Route::get('query', function(){
	$user = App\User::withTrashed()->where('id','>=',1)->get();
	return $user;
});
//Restoring Soft Deleted Models
Route::get('restore', function(){
	$user = App\TinTuc::withTrashed()->where('id','=',19)->restore();
	
});
Route::get('restore1', function(){
	$user = App\Loaitin::withTrashed()->where('id','=',2)->restore();
	
});

/**
 * End Tự làm - Soft Delete
 */

Route::get('home', 'PagesController@home');
Route::get('contact', 'PagesController@contact');
Route::get('loaitin/{id}', 'PagesController@loaitin');
Route::get('tintuc/{id}/{TieuDeKoDau}.html','PagesController@tintuc');
Route::get('login', 'PagesController@getDangNhap');
Route::post('login', 'PagesController@postDangNhap');
Route::get('logout', 'PagesController@logout');
Route::post('comment/{id_tintuc}/{id_user}','CommentController@postComment');
Route::get('user-settings/{user}', 'PagesController@userSettings');
Route::post('user-settings','PagesController@postuserSettings');
Route::get('register','PagesController@getRegister');
Route::post('register','PagesController@postRegister');
Route::get('search',['as' => 'search', 'uses' => 'PagesController@search']);
Route::get('search-complex',['as' => 'search-complex', 'uses' => 'PagesController@searchComplex']);