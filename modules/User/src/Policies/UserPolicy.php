<?php

namespace Modules\User\src\Policies;


use Modules\User\src\Models\User;
use Modules\Groups\src\Models\Groups;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */

    



    public function viewAny($user)
    {
        $group = Groups::where('id', $user->group_id)->first();
        $roleJson = $group->permissions;
        
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'users');
            return $check;

        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create( $user)
    {
        $group = Groups::where('id', $user->group_id)->first();
        $roleJson = $group->permissions;
        
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'users', 'add');
            return $check;

        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user)
    {
        $group = Groups::where('id', $user->group_id)->first();
        $roleJson = $group->permissions;
        
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'users', 'edit');
            return $check;

        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete( $user)
    {
        $group = Groups::where('id', $user->group_id)->first();
        $roleJson = $group->permissions;
        
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'users', 'delete');
            return $check;

        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
