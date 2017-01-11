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

//Auth::routes();
//use App\Events\SomeEvent;

Route::get('/', 'HomeController@index');
Route::get('test', function(){	
	//echo OptionsHelper::delete('site_url');
	// $event = new SomeEvent();
	// $event->logoutUser();

	// $a = event($event);
	// dd($a);
	// $user =  new App\Models\User;
	// $user->name = 'ltrtuan';
	// $user->email = 'ltrtuan@gmail.com';
	// $user->password = bcrypt('123456');
	// $user->parent = '0';
	// $user->role_id = '1';
	// $user->status = '1';
	// $user->save();
	
	
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/',  ['as' => 'profile_path', 'uses' => 'UserController@profile']);
	Route::get('register',  ['as' => 'register_path', 'uses' => 'UserController@register']);
	Route::post('register',  ['as' => 'create_user_path', 'uses' => 'UserController@create']);

	Route::get('login',  ['as' => 'login_path', 'uses' => 'UserController@loginForm']);
	Route::post('login',  ['as' => 'action_login_path', 'uses' => 'UserController@login']);

	Route::get('logout',  ['as' => 'logout_path', 'uses' => 'UserController@logout']);

	Route::get('profile',  ['as' => 'profile_path', 'uses' => 'UserController@profile']);
	Route::patch('profile',  ['as' => 'update_user_path', 'uses' => 'UserController@update']);

	/**
	 * THE ACTION USE MEDTHODS OF Illuminate\Foundation\Auth\SendsPasswordResetEmails TRAIT
	 */
	Route::get('forgot-password',  ['as' => 'forgot_pass_path', 'uses' => 'ExtendUserController\ForgotPasswordController@showLinkRequestForm']);
	Route::post('forgot-password',  ['as' => 'forgot_pass_path', 'uses' => 'ExtendUserController\ForgotPasswordController@sendResetLinkEmail']);

	Route::get('reset-password/{token}',  ['as' => 'reset_pass_path', 'uses' => 'ExtendUserController\ResetPasswordController@showResetForm']);
	Route::post('reset-password',  ['as' => 'reset_pass_path', 'uses' => 'ExtendUserController\ResetPasswordController@reset']);
});

// Route::get('/profile', 'UserController@showProfileForm');
// Route::get('/login', 'UserController@showLoginForm');
