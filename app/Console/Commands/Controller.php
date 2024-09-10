<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class Controller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-controller {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Created controller Module';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $name = $this->argument('name');
        $module = $this->argument('module');

        if (!File::exists(base_path('modules/' . $module))) {
            return $this->error('Module not exists');
        }

        $srcFolder = base_path('modules/'.$module.'/src');

        if(File::exists($srcFolder)){
            $httpFolder = base_path('modules/'.$module.'/src/Http');

            if(File::exists($httpFolder)){
                $controllerFolder = base_path('modules/'.$module.'/src/Http/Controllers');
                if(File::exists($controllerFolder)){
                    $controlerFile = app_path('Console/Commands/Templates/Controller.txt');
                    $controlerContent = File::get($controlerFile);
                    $controlerContent = str_replace('{module}', $module, $controlerContent);
                    $controlerContent = str_replace('{name}', $name, $controlerContent);
                    
                    if(!File::exists($controllerFolder.'/'.$name.'.php')){
                        File::put($controllerFolder.'/'.$name.'.php', $controlerContent);
                        return $this->info('Controller created successfully');
                    }else{
                        return $this->error('Controller alrealdy exists!');
                    }
                }   
            }
        }
        return $this->error('Base Folser Module Not Exists!');
    }
}
