<?php

namespace App\CustomFacadeFunction;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ViewComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        $this->users = Auth::user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function getCurrentUser(View $view)
    {
        $view->with('current_user', $this->users);
    }
}