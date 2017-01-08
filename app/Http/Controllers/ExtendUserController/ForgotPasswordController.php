<?php

namespace App\Http\Controllers\ExtendUserController;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * OVERRIDE METHOD OF SendsPasswordResetEmails trait;
     */   
    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('user.forgotPassPage');
    }
    /**
     * http://stackoverflow.com/questions/30290721/how-to-override-reset-and-validatepasswordwithdefaults-in-passwordbroker-laravel
     * http://stackoverflow.com/questions/30290721/how-to-override-reset-and-validatepasswordwithdefaults-in-passwordbroker-laravel?rq=1
     * https://laracasts.com/discuss/channels/general-discussion/laravel-5-password-reset-link-subject
     * https://laracasts.com/discuss/channels/general-discussion/laravel-5-password-broker?page=1
     */
}
