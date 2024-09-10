<?php

namespace Modules\Agents\src\Policies;


use Modules\User\src\Models\User;
use Modules\Agents\src\Models\Agent;
use Modules\Groups\src\Models\Groups;

use Illuminate\Auth\Access\HandlesAuthorization;

class AgentPolicy
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
            $check = isRole($roleArr, 'agents');
            
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  Agents  $agents
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Agents $agents)
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
            $check = isRole($roleArr, 'agents', 'add');
            return $check;

        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agents  $agents
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update( $user)
    {
        $group = Groups::where('id', $user->group_id)->first();
        $roleJson = $group->permissions;
        
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'agents', 'edit');
            return $check;

        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agents  $agents
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user)
    {
        $group = Groups::where('id', $user->group_id)->first();
        $roleJson = $group->permissions;
        
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'agents', 'delete');
            return $check;

        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agents  $agents
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Agents $agents)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Agents  $agents
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Agents $agents)
    {
        //
    }
}
