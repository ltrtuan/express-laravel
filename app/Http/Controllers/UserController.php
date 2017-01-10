<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\CreateUserRequest;
use CreateConnection;

use Exception;


class UserController extends Controller
{
  
    use AuthenticatesUsers;   

    /**
     * [$redirectTo Where to redirect after login or register]
     * @var string
     */
    protected $redirectTo = '/';
    // public function redirectTo(){
    // 	return redirect()->to('/');
    // }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'logout',
            'profile',
            'register'
        ]]);

        $this->middleware('guest', ['only' => [ 
            'login',
            'showLinkRequestForm', 
            'loginForm'
        ]]);

    }

    /**
     * [register: Show Register form]
     * @return [type] [description]
     */
    public function register(){
    	$currentUser = Auth::user();
        $template = view()->file(app_path('HtmlRender/registerForm.blade.php'),compact('currentUser') );
        return view('user.registerPage', compact('template'));
    }
    

    /**
     * [loginForm: Show Form Login]
     * @return [type] [description]
     */
    public function loginForm(){
        $template = view()->file(app_path('HtmlRender/loginForm.blade.php'));
        return view('user.loginPage', compact('template'));
    }
    

    /**
     * OVERRIDE METHOD OF AuthenticatesUsers trait;
     */
    /**
     * [loginAction Logic for login user]
     * @return [type] [description]
     */
    public function login(LoginRequest $request){
        $credentials = array();
        /**
         * LOGIN USE BOTH USERNAME AND EMAIL
         */
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {         
            $credentials = array('email' => $request->username, 'password' => $request->password, 'status' => 1);
        }else{
            $credentials = array('name' => $request->username, 'password' => $request->password, 'status' => 1);
        }
        
        /**
         * BLOCK USER HAVE MANY ATTEMPS LOGIN
         */
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        

        /**
         * LOGIN IS SUCCESSFUL
         */
        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            $request->session()->flash('alert-success', trans('users.login_user_success'));  
            $resultLogin =  $this->sendLoginResponse($request);          
            return $resultLogin;
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        
        /**
         * LOGIN IS FAILED
         */
        $request->session()->flash('alert-danger', trans('users.login_user_fail'));  
        return redirect()->route('login_path');     
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        /**
         * tooManyAttempts(request, maxattemps, time by minutes)
         */
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), 2, 1
        );
    }

    /**
     * [username Return name of input store value NAME in database]
     * @return [type] [description]
     */
    public function username()
    {
        return 'username';
    }

    /**
     * [logout Just log out user]
     * @return [type] [description]
     */    
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->to('/')->with('alert-success', trans('users.logout_user_success'));
    }
    /**
    * END OVERRIDE METHOD OF AuthenticatesUsers trait;
    */
   

    
    /**
     * [profile: show profile action]
     * @return [type] [description]
     */
    public function profile(){
        $user = Auth::user();
        if($user->id != 0){
            return view('user.profilePage', compact('user'));
        }

        return redirect()->route('login_path');
    }


    /**
     * [create create new user from register action]
     * @return [type] [description]
     */
    public function create(CreateUserRequest $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        $user = User::create($request->all());
        
        if($user->id > 0)
        {            
            if($user->role_id == 2){        
            	CreateConnection::createTable(CreateConnection::getNameDatabaseUser($user->id));
        	}
            $request->session()->flash('alert-success', trans('users.create_user_success'));  
            return redirect()->route('register_path');
        }
        $request->session()->flash('alert-danger', trans('users.create_user_fail'));  
        return redirect()->route('register_path');
    }

    /**
     * [update update user when user update profile]
     * @return [type] [description]
     */
    public function update(UpdateProfileRequest $request)
    {
        $currentUser = Auth::user();
        $currentUser->fullname = $request->input('fullname');
        $currentUser->email = $request->input('email');
        $currentUser->country_id = $request->input('country_id');
        if ( ! $request->input('password_input') == '')
        {
            $currentUser->password = bcrypt($request->input('password_input'));
        }
        try {
            $currentUser->save();
            $request->session()->flash('alert-success', trans('users.update_user_success'));
        } catch (\Exception $e) {            
            $request->session()->flash('alert-danger', trans('users.update_user_fail'));
        }        
        
        return redirect()->route('profile_path');
    }
    
}