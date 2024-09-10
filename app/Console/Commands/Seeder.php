<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class Seeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-seeder {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Created seeder Module';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->argument('module');

        if (!File::exists(base_path('modules/' . $module))) {
            return $this->error('Module not exists');
        }

        $seederFolder = base_path('modules/'.$module.'/seeders');

        if(!File::exists($seederFolder)){
            File::makeDirectory($seederFolder, 0755, true, true);
        }

        if(File::exists($seederFolder)){
            $seederFile = app_path('Console/Commands/Templates/Seeder.txt');
            $seederContent = File::get($seederFile);
            $seederContent = str_replace('{name}', $name, $seederContent);
            $seederContent = str_replace('{module}', $module, $seederContent);

            if(!File::exists($seederFolder.'/'.$name.'.php')){
                File::put($seederFolder.'/'.$name.'.php', $seederContent);
                return $this->info('Seeder created successfully');
            }
        }
        return $this->error('Base Folser Module Not Exists!');
    }
}
