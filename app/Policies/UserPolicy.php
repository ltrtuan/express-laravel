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
        return $this->showAndEditPolicy($currentUser, $modelUser);
    }

    public function updateEdit(User $currentUser, User $modelUser)
    {
        return $this->showAndEditPolicy($currentUser, $modelUser);
    }

    private function showAndEditPolicy(User $currentUser, User $modelUser)
    {
        if($currentUser->role_id == 2)
        {            
            return ($currentUser->id == $modelUser->parent_id || $currentUser->id == $modelUser->id);
        }
        else if($currentUser->role_id == 3)
        {
            return ($currentUser->parent_id == $modelUser->parent_id || $currentUser->id == $modelUser->id);
        }
        else if($currentUser->role_id == 1)
        {
            return ($modelUser->role_id == 2 || $modelUser->role_id == 1);
        }
        return false;
    }
   
}
