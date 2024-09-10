<?php

namespace Modules\Policy\src\Policies;


use Modules\User\src\Models\User;
use Modules\Policy\src\Models\Policy;
use Modules\Groups\src\Models\Groups;

use Illuminate\Auth\Access\HandlesAuthorization;

class PolicyPolicy
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
        dd($roleJson);
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'policy');
            
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  Policy  $games
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Games $games)
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
        
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update( $user)
    {
        $group = Groups::where('id', $user->group_id)->first();
        $roleJson = $group->permissions;
        
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'policy', 'edit');
            return $check;

        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user)
    {
        
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Games $games)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Games $games)
    {
        //
    }
}
