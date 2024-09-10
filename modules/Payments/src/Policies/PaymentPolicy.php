<?php

namespace Modules\Payments\src\Policies;


use Modules\User\src\Models\User;
use Modules\Groups\src\Models\Groups;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Payments\src\Policies\PaymentPolicy;


class PaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny( $user)
    {

        $group = Groups::where('id', $user->group_id)->first();
        $roleJson = $group->permissions;
       
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'payments');
            
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  Payments  $payments
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Payments $Payments)
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
            $check = isRole($roleArr, 'payments', 'add');
            return $check;

        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payments  $Payments
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update( $user)
    {
        $group = Groups::where('id', $user->group_id)->first();
        $roleJson = $group->permissions;
        
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'payments', 'edit');
            return $check;

        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user)
    {
        $group = Groups::where('id', $user->group_id)->first();
        $roleJson = $group->permissions;
        
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'payments', 'delete');
            return $check;

        }
        return false;
    }


    public function confirm($user){
        $group = Groups::where('id', $user->group_id)->first();
        $roleJson = $group->permissions;
        
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'payments', 'confirm');
            return $check;
        }
        return false;
    }

    public function report($user){
        $group = Groups::where('id', $user->group_id)->first();
        $roleJson = $group->permissions;
        
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'payments', 'report');
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Payments $payments)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Payments $payments)
    {
        //
    }
}
