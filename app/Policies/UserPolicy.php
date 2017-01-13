<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $user
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function index(User $currentUser)
    {
        return $currentUser->role_id != 4;
    }

    public function showEditForm(User $currentUser, User $modelUser)
    {
        return ($currentUser->id == $modelUser->parent || $currentUser->role_id == 1);
    }

    public function updateEdit(User $currentUser, User $modelUser)
    {
        return ($currentUser->id == $modelUser->parent || $currentUser->role_id == 1);
    }
   
}
