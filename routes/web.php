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
	// $user->parent_id = '0';
	// $user->role_id = '1';
	// $user->status = '1';
	// $user->save();
	
	
});



Route::group(['middleware' => 'web'], function (){
	Route::bind('user', function($id){
		return App\Models\User::find($id);
	});
	Route::group(['prefix' => 'user'], function () {
	    Route::get('/',  ['as' => 'list_users_path', 'uses' => 'UserController@index']);
		Route::get('register',  ['as' => 'register_path', 'uses' => 'UserController@register']);
		Route::post('register',  ['as' => 'create_user_path', 'uses' => 'UserController@create']);

		Route::get('login',  ['as' => 'login_path', 'uses' => 'UserController@loginForm']);
		Route::post('login',  ['as' => 'action_login_path', 'uses' => 'UserController@login']);

		Route::get('logout',  ['as' => 'logout_path', 'uses' => 'UserController@logout']);

		Route::get('profile',  ['as' => 'profile_path', 'uses' => 'UserController@profile']);
		Route::patch('profile',  ['as' => 'update_user_path', 'uses' => 'UserController@update']);

		Route::get('edit/{user}',  ['as' => 'edit_user_path', 'uses' => 'UserController@showEditForm']);
		Route::patch('edit/{user}',  ['as' => 'edit_user_path', 'uses' => 'UserController@updateEdit']);

		Route::delete('delete/{user}',  ['as' => 'delete_user_path', 'uses' => 'UserController@delete']);

		Route::post('delete-ajax',  ['as' => 'delete_user_path_ajax', 'uses' => 'UserController@delete_ajax']);
		/**
		 * THE ACTION USE MEDTHODS OF Illuminate\Foundation\Auth\SendsPasswordResetEmails TRAIT
		 */
		Route::get('forgot-password',  ['as' => 'forgot_pass_path', 'uses' => 'ExtendUserController\ForgotPasswordController@showLinkRequestForm']);
		Route::post('forgot-password',  ['as' => 'forgot_pass_path', 'uses' => 'ExtendUserController\ForgotPasswordController@sendResetLinkEmail']);

		Route::get('reset-password/{token}',  ['as' => 'reset_pass_path', 'uses' => 'ExtendUserController\ResetPasswordController@showResetForm']);
		Route::post('reset-password',  ['as' => 'reset_pass_path', 'uses' => 'ExtendUserController\ResetPasswordController@reset']);
	});
	
	
	Route::bind('optionParent', function($id){
		return App\Models\ListOption::find($id);
	});
	Route::group(['prefix' => 'list-option'], function () {
	    Route::get('/',  ['as' => 'list_list_option_path', 'uses' => 'ListOptionController@index']);

		Route::get('create/{optionParent}',  ['as' => 'create_list_option_child_path', 'uses' => 'ListOptionController@create']);
		Route::post('create/{optionParent}',  ['as' => 'create_list_option_child_path', 'uses' => 'ListOptionController@save']);

		Route::get('edit/{user}',  ['as' => 'edit_list_option_path', 'uses' => 'UserController@showEditForm']);
		Route::patch('edit/{user}',  ['as' => 'edit_list_option_path', 'uses' => 'UserController@updateEdit']);

		Route::delete('delete/{user}',  ['as' => 'delete_user_path', 'uses' => 'UserController@delete']);

		Route::post('delete-ajax',  ['as' => 'delete_list_option_path_ajax', 'uses' => 'UserController@delete_ajax']);
	
		Route::get('forgot-password',  ['as' => 'forgot_pass_path', 'uses' => 'ExtendUserController\ForgotPasswordController@showLinkRequestForm']);
		Route::post('forgot-password',  ['as' => 'forgot_pass_path', 'uses' => 'ExtendUserController\ForgotPasswordController@sendResetLinkEmail']);

		Route::get('reset-password/{token}',  ['as' => 'reset_pass_path', 'uses' => 'ExtendUserController\ResetPasswordController@showResetForm']);
		Route::post('reset-password',  ['as' => 'reset_pass_path', 'uses' => 'ExtendUserController\ResetPasswordController@reset']);
	});


});


// Route::get('/profile', 'UserController@showProfileForm');
// Route::get('/login', 'UserController@showLoginForm');
