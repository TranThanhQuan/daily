<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create module CLI';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
        {
            $name = $this->argument('name');

            if (File::exists(base_path('modules/' . $name))) {
                $this->error('Module already exists');
                return 1;
            } else {
                File::makeDirectory(base_path('modules/' . $name), 0755, true, true);

                // config
                $configFolder = base_path('modules/'.$name.'/configs');
                // nếu folder config không tồn tại thì tạo mới
                if(!File::exists($configFolder)){
                    File::makeDirectory($configFolder, 0755, true, true);
                }

                //helper
                $helperFolder = base_path('modules/'.$name.'/helpers');
                // nếu folder không tồn tại thì tạo mới
                if(!File::exists($helperFolder)){
                    File::makeDirectory($helperFolder, 0755, true, true);
                }

                //migrations
                $migrationsFolder = base_path('modules/'.$name.'/migrations');
                // nếu folder không tồn tại thì tạo mới
                if(!File::exists($migrationsFolder)){
                    File::makeDirectory($migrationsFolder, 0755, true, true);
                }

                // resources 
                $resourcesFolder = base_path('modules/'.$name.'/resources');
                // nếu folder không tồn tại thì tạo mới
                if(!File::exists($resourcesFolder)){
                    File::makeDirectory($resourcesFolder, 0755, true, true);

                    //language
                    $languageFolder = base_path('modules/'.$name.'/resources/lang');
                    // nếu folder config không tồn tại thì tạo mới
                    if(!File::exists($languageFolder)){
                        File::makeDirectory($languageFolder, 0755, true, true);
                    }


                    // views
                    $viewsFolder = base_path('modules/'.$name.'/resources/views');
                    // nếu folder config không tồn tại thì tạo mới
                    if(!File::exists($viewsFolder)){
                        File::makeDirectory($viewsFolder, 0755, true, true);
                    }
                }


                //route
                $routesFolder = base_path('modules/'.$name.'/routes');
                // nếu folder config không tồn tại thì tạo mới
                if(!File::exists($routesFolder)){
                    File::makeDirectory($routesFolder, 0755, true, true);

                    // tạo file web.php
                    $routesWebFile = base_path('modules/'.$name.'/routes/web.php');
                    $routeContent = file_get_contents(app_path('Console/Commands/templates/Route.txt'));
                    $routeContent = str_replace('{module}', strtolower($name), $routeContent);
                    if(!File::exists($routesWebFile)){
                        File::put($routesWebFile, $routeContent);
                    }

                    // tạo file api.php
                    $routesApiFile = base_path('modules/'.$name.'/routes/api.php');
                    if(!File::exists($routesApiFile)){
                        File::put($routesApiFile, $routeContent);
                    }
                }
                

                // src
                $srcFolder = base_path('modules/'.$name.'/src');
                // nếu folder không tồn tại thì tạo mới
                if(!File::exists($srcFolder)){
                    File::makeDirectory($srcFolder, 0755, true, true);

                    //Tạo folder commands
                    $commandsFolder = base_path('modules/'.$name.'/src/Commands');
                    // nếu folder không tồn tại thì tạo mới
                    if(!File::exists($commandsFolder)){
                        File::makeDirectory($commandsFolder, 0755, true, true);
                    }


                    //Tạo folder Http
                    $httpFolder = base_path('modules/'.$name.'/src/Http');
                    // nếu folder không tồn tại thì tạo mới
                    if(!File::exists($httpFolder)){
                        File::makeDirectory($httpFolder, 0755, true, true);

                        //Tạo folder controller
                        $controllerFolder = base_path('modules/'.$name.'/src/Http/Controllers');
                        // nếu folder không tồn tại thì tạo mới
                        if(!File::exists($controllerFolder)){
                            File::makeDirectory($controllerFolder, 0755, true, true);
                        }


                        //Tạo folder middleware
                        $middlewareFolder = base_path('modules/'.$name.'/src/Http/Middlewares');
                        // nếu folder không tồn tại thì tạo mới
                        if(!File::exists($middlewareFolder)){
                            File::makeDirectory($middlewareFolder, 0755, true, true);
                        }
                    }


                    //Tạo folder Http
                    $httpFolder = base_path('modules/'.$name.'/src/Http');
                    // nếu folder không tồn tại thì tạo mới
                    if(!File::exists($httpFolder)){
                        File::makeDirectory($httpFolder, 0755, true, true);

                        //controllers
                        $controllerFolder = base_path('modules/'.$name.'/src/Http/Controllers');
                        if(!File::exists($controllerFolder)){
                            FileStorage::makeDirectory($controllerFolder , 0755, true, true);
                        }


                        //Middlewares
                        $middlewaresFolder = base_path('modules/'.$name.'/src/Http/Middlewares');
                        if(!File::exists($middlewaresFolder)){
                            FileStorage::makeDirectory($middlewaresFolder , 0755, true, true);
                        }
                    }


                    // Models
                    $modelsFolder = base_path('modules/'.$name.'/src/Models');
                    if(!File::exists($modelsFolder)){
                        File::makeDirectory($modelsFolder , 0755, true, true);
                    }


                    //Repositories
                    $repositoriesFolder = base_path('modules/'.$name.'/src/Repositories');
                    if(!File::exists($repositoriesFolder)){
                        File::makeDirectory($repositoriesFolder, 0755, true, true);
                        
                        //module repository
                        $moduleRepositoryFile = base_path('modules/'.$name.'/src/Repositories/'.$name.'Repository.php');
                        
                        if(!File::exists($moduleRepositoryFile)){
                            $moduleRepositoryFileContent = file_get_contents(app_path('Console/Commands/templates/ModuleRepository.txt'));
                            $moduleRepositoryFileContent = str_replace('{module}', $name, $moduleRepositoryFileContent);

                            File::put($moduleRepositoryFile, $moduleRepositoryFileContent);
                        }


                        // tạo file interface repository
                        $moduleRepositoryInterfaceFile = base_path('modules/'.$name.'/src/Repositories/'.$name.'RepositoryInterface.php');
                        
                        if(!File::exists($moduleRepositoryInterfaceFile)){
                            $moduleRepositoryInterfaceFileContent = file_get_contents(app_path('Console/Commands/templates/ModuleRepositoryInterface.txt'));
                            $moduleRepositoryInterfaceFileContent = str_replace('{module}', $name, $moduleRepositoryInterfaceFileContent);

                            File::put($moduleRepositoryInterfaceFile, $moduleRepositoryInterfaceFileContent);
                        }



                    }
                }
                $this->info('Module created successfully');
            }
        }

}
