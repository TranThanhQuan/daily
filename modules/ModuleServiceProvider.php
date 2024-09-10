<?php
namespace Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\User\src\Commands\TestCommand;
use Modules\User\src\Repositories\UserRepository;
use Modules\Games\src\Repositories\GamesRepository;
use Modules\Agents\src\Repositories\AgentsRepository;
use Modules\Groups\src\Repositories\GroupsRepository;
use Modules\Policy\src\Repositories\PolicyRepository;
use Modules\User\src\Http\Middlewares\DemoMiddleware;
use Modules\Groups\src\Repositories\ModulesRepository;
use Modules\Payments\src\Repositories\PaymentsRepository;
use Modules\Auth\src\Http\Middlewares\BlockUserMiddleware;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Modules\Games\src\Repositories\GamesRepositoryInterface;
use Modules\Agents\src\Repositories\AgentsRepositoryInterface;
use Modules\Groups\src\Repositories\GroupsRepositoryInterface;
use Modules\Policy\src\Repositories\PolicyRepositoryInterface;
use Modules\Groups\src\Repositories\ModulesRepositoryInterface;
use Modules\Payments\src\Repositories\PaymentsRepositoryInterface;

class ModuleServiceProvider extends ServiceProvider{

    private $middlewares = [
        'demo' => DemoMiddleware::class,
        'user.block' => BlockUserMiddleware::class
    ];

    private $commands = [
        TestCommand::class
    ];


    public function bindingRepository(){
        //users repository
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        ); 

        //agents repository
        $this->app->singleton(
            AgentsRepositoryInterface::class,
            AgentsRepository::class
        ); 

        //apis repository
        $this->app->singleton(
            ApisRepositoryInterface::class,
            ApisRepository::class
        ); 


        //games repository
        $this->app->singleton(
            GamesRepositoryInterface::class,
            GamesRepository::class
        ); 


        //Groups repository
        $this->app->singleton(
            GroupsRepositoryInterface::class,
            GroupsRepository::class
        );

        //Modules repository
        $this->app->singleton(
            ModulesRepositoryInterface::class,
            ModulesRepository::class
        );

        //Payments repository
        $this->app->singleton(
            PaymentsRepositoryInterface::class,
            PaymentsRepository::class
        );

        //Policy repository
        $this->app->singleton(
            PolicyRepositoryInterface::class,
            PolicyRepository::class
        );

        
    }


    public function register(){
        //configs
        $modules = $this->getModules();
        if(!empty($modules)){
            foreach($modules as $module){
                $this->registerConfig($module);
            }
        }


        // middleware  
        $this->registerMiddleware();


        //commands
        $this->commands($this->commands);


        //Repository 
        $this->bindingRepository();
        
    }

    public function boot(){
        $modules = $this->getModules();
        
        if(!empty($modules)){
            foreach($modules as $module){
                $this->registerModule($module);
            } 
        }

        $request = request();
        if($request->is('admin') || $request->is('admin/*')){
            $this->app['router']->pushMiddlewareToGroup('web', 'auth');
        }




    }

    private function registerModule($module){   
        $modulePath = __DIR__."/{$module}";
        
        //khai báo routes nếu file tồn tại
        Route::group(['namespace' => "Modules\\{$module}\src\Http\Controllers", 'middleware' => 'web'], function() use($modulePath){
            if(File::exists($modulePath.'/routes/web.php')){
                $this->loadRoutesFrom($modulePath.'/routes/web.php');
            }
        });

        Route::group(['namespace' => "Modules\\{$module}\src\Http\Controllers", 'middleware' => 'api', 'prefix'=>'api'], function() use($modulePath){
            if(File::exists($modulePath.'/routes/api.php')){
                $this->loadRoutesFrom($modulePath.'/routes/api.php');
            }
        });
        
        

        //khai báo migrations nếu file tồn tại
        if(File::exists($modulePath.'/migrations')){
            $this->loadMigrationsFrom($modulePath.'/migrations');
        }

        //khai báo languages nếu file tồn tại
        if(File::exists($modulePath.'/resources/lang')){
            $this->loadTranslationsFrom($modulePath.'/resources/lang', strtolower($module));
                
            //load file ngôn ngữ theo file json
            $this->loadJSONTranslationsFrom($modulePath.'/resources/lang');
        }


        //khai báo view nếu file tồn tại
        if(File::exists($modulePath.'/resources/views')){
            $this->loadViewsFrom($modulePath.'/resources/views', strtolower($module));
        }


        //khai báo helpers nếu file tồn tại
        if(File::exists($modulePath.'/helpers')){
            // lấy tất cả file trong helper
            $helperList = File::allFiles($modulePath.'/helpers');

            if(!empty($helperList)){
                // lặp qua hepler
                foreach($helperList as $helper){
                    // lấy ra path của helper sau đó require helper
                    $file = $helper->getPathName();
                    require $file;
                }
            }
        }


    }



    private function getModules(){
        return array_map('basename', File::directories(__DIR__));
    }

    private function registerConfig($module){
        //khai báo config
        $configPath = __DIR__.'/'.$module.'/configs';
        if(File::exists($configPath)){
            $configFiles = array_map('basename', File::allFiles($configPath));

            foreach($configFiles as $config){
                
                $alias = basename($config, '.php');
                $this->mergeConfigFrom($configPath.'/'.$config, $alias);
            }
        }
    }



    //register middlware
    private function registerMiddleware(){
        if(!empty($this->middlewares)){
            foreach($this->middlewares as $key=>$middleware){
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }
}























