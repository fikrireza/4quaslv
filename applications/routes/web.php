<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Auth::routes();
Route::post('login-process', 'Auth\LoginController@loginProcess')->name('login');
Route::get('admin/logout-process', 'Auth\LoginController@logoutProcess')->name('logout');
// END Auth::routes()

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login.pages');

//Verify User CMS
Route::get('admin/verify/{confirmation_code}', 'Backend\UserController@verify')->name('verify.index')->middleware('guest');
Route::post('admin/verify', 'Backend\UserController@store')->name('verify.store');

Route::get('admin/dashboard', 'Backend\DashboardController@index')->name('admin.dashboard');
//----------------------- BACKEND -----------------------//
Route::group(['middleware' => ['isAdministrator']], function () {

  // User
  Route::get('admin/users', 'Backend\UserController@index')->name('users.index');
  Route::get('admin/users/reset/{id}', 'Backend\UserController@reset')->name('users.reset');
  Route::post('admin/users', 'Backend\UserController@newUser')->name('users.new');

});
//----------------------- BACKEND -----------------------//



// FRONTEND
Route::get('bahasa/{bhs}', 'HomeController@language')->where('lang', '[A-Za-z_-]+');

Route::get('/', function(){
		return view('index');
	})->name('frontend.home');

// Sitemap
Route::get('sitemap.xml', 'Backend\SitemapController@index')->name('sitemap.index');
