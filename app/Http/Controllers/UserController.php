<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use CreateConnection;
use InvalidArgumentException;
use Exception;
use DB;

class UserController extends Controller
{
  
    use AuthenticatesUsers;   
    public $postPerPage = 10;
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
            'register',
            'index',
            'updateEdit',
            'showEditForm',
            'delete'
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
    public function loginForm()
    {
        $template = view()->file(app_path('HtmlRender/loginForm.blade.php'));
        return view('user.loginPage', compact('template'));
    }
    

    private function checkUserParentActive($idUserParent)
    {
        $userParentExist = User::whereId($idUserParent)->first();        
        if($userParentExist->status == 0)    
           return false;      
        else
            return true;
    }
    /**
     * OVERRIDE METHOD OF AuthenticatesUsers trait;
     */
    /**
     * [loginAction Logic for login user]
     * @return [type] [description]
     */
    public function login(LoginRequest $request)
    {
        $credentials = array();
        /**
         * LOGIN USE BOTH USERNAME AND EMAIL
         */
        $nameOrEmail = 'name';
        $verifyUserParentActive = true;
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $nameOrEmail = 'email';            
            $userExist = User::whereEmail($request->username)->first();
            if($userExist->role_id == 3 || $userExist->role_id == 4)
            {
                $verifyUserParentActive = $this->checkUserParentActive($userExist->parent_id);
            }
        }else{
            $userExist = User::whereName($request->username)->first();
            if($userExist->role_id == 3 || $userExist->role_id == 4)
            {
                $verifyUserParentActive = $this->checkUserParentActive($userExist->parent_id);
            }
        }

        if($verifyUserParentActive == true)
        {
            $credentials = array($nameOrEmail => $request->username, 'password' => $request->password, 'status' => 1);
            
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
        }// if($verifyUserParentActive == true)
        
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
        $currentUser = Auth::user();
        if($user->id > 0)
        {            
            /**
             * Just create new database, new table in case NEW MANAGER WAS CREATED BY SUPER ADMIN           
             */
            if($user->role_id == 2 && $currentUser->role_id == 1){
            	/**
            	 * FIRST CREATE SCHEMA
            	 */
            	$createSchema = CreateConnection::createSchema($user->id);
            	if($createSchema)
            	{
            		/**
            		 * THEN CREATE NEW CONNECTION WITH ABOVE SCHEMA, AFTER THAT CREATE TABLE BY ARTISAN MIGRATE     	
            		 */
            		$newConnection = CreateConnection::setupConnection($user->id);
            		if($newConnection)
            		{
            			$createTable = CreateConnection::createTable($user->id);            			
	            		if($createTable instanceof InvalidArgumentException)
	            		{
	            			$request->session()->flash('alert-danger', trans('users.create_user_fail'));  
	        				return redirect()->route('register_path');
	            		}
            		}            	
            	}
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
        $currentUser->name = $request->input('name');
        $currentUser->email = $request->input('email');     
        if ( ! $request->input('password') == '')
        {
            $currentUser->password = bcrypt($request->input('password'));
        }
        try {
            $currentUser->save();
            $request->session()->flash('alert-success', trans('users.update_user_success'));
        } catch (\Exception $e) {            
            $request->session()->flash('alert-danger', trans('users.update_user_fail'));
        }        
        
        return redirect()->route('profile_path');
    }

    public function index()
    {

        $this->authorize('index', User::class);
        $currentUser = Auth::user();
        if($currentUser->role_id == 2)
        {
            $users = User::where('parent_id', '=', $currentUser->id)->orWhere('id', '=', $currentUser->id)->paginate($this->postPerPage);
        }
        else if($currentUser->role_id == 3)
        {
        	$users = User::where('parent_id', '=', $currentUser->id)->orWhere('parent_id', '=', $currentUser->parent_id)->paginate($this->postPerPage);
        }
        else if($currentUser->role_id == 1)
        {
            $users = User::where('role_id', '=', '1')->orWhere('role_id', '=', '2')->paginate($this->postPerPage);
        }
        
        return view('user.list',compact('users'));
    }

    public function updateEdit(User $user, EditUserRequest $request)
    {
    	$this->authorize('updateEdit', $user);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->status = $request->input('status');
        $user->role_id = $request->input('role_id');
        if ( ! $request->input('password_input') == '')
        {
            $user->password = bcrypt($request->input('password_input'));
        }

        try {
            $user->save();
            $request->session()->flash('alert-success', trans('users.update_user_success'));
        } catch (\Exception $e) {            
            $request->session()->flash('alert-danger', trans('users.update_user_fail'));
        }
        return redirect()->route('edit_user_path',$request->id);
    }

    public function showEditForm(User $user)
    {
        $this->authorize('showEditForm', $user);
        $currentUser = Auth::user();
        return view('user.editPage', compact('user', 'currentUser'));
    }

    public function delete(User $user){      
        if($user->role_id == 2)
        {            
            if(CreateConnection::checkDBUserExist($user->id))
                DB::statement('DROP DATABASE '.CreateConnection::getNameDatabaseUser($user->id));
        }      
    	$user->delete();
    	return redirect()->route('list_users_path');
    }

    public function delete_ajax(Request $request){
        $listIdUser = $request->input('id_user');
        foreach ($listIdUser as $idUser) {
           $userExist = User::whereId($idUser)->first();
           if($userExist)
           {
                if($userExist->role_id == 2)
                {
                    if(CreateConnection::checkDBUserExist($idUser))
                        DB::statement('DROP DATABASE '.CreateConnection::getNameDatabaseUser($idUser));
                }
           }
        }
        
        return User::destroy($listIdUser);       
    }

}