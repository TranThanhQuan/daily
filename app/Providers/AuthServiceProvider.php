<?php

namespace App\Providers;

use Modules\User\src\Models\User;
use Modules\Games\src\Models\Games;
use Illuminate\Support\Facades\Gate;
use Modules\Groups\src\Models\Groups;
use Modules\Groups\src\Models\Modules;
use Modules\Payments\src\Models\Payments;
use Modules\User\src\Policies\UserPolicy;
use Modules\Games\src\Policies\GamePolicy;
use Modules\Agents\src\Policies\AgentPolicy;
use Modules\Groups\src\Policies\GroupPolicy;
use Modules\Payments\src\Policies\PaymentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Games::class => GamePolicy::class,
        Groups::class => GroupPolicy::class,
        Policy::class => PolicyPolicy::class,
        Payments::class => PaymentPolicy::class,
        Agents::class => AgentPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //lấy danh sách module
        $moduleList = Modules::all();
        
        if($moduleList->count()>0){
            foreach($moduleList as $module){
                
                Gate::define($module->name, function($user) use ($module){
                    // lấy ra permission từ group 
                    // $roleJson có dạng: {"users":["view"],"groups":["view"],"posts":["view"]}
                    $group = Groups::where('id', $user->group_id)->first();
                    $roleJson = $group->permissions;
                    
                    if(!empty($roleJson)){
                        $roleArr = json_decode($roleJson, true);
                        //isRole() có chức năng kiểm tra xem một người dùng có quyền (role) trong một module ($module->name) cụ thể hay không 
                        //nếu có thì trả về true, không thì trả về false
                        $check = isRole($roleArr, $module->name);
                        return $check;

                    }

                    return false;
                });   
            }

        }
                    
    }
}
