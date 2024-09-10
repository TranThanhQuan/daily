<?php

namespace App\Console\Commands;

use File;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Migration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-migration {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Created migration module';

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

        $migrationFolder = base_path('modules/'.$module.'/migrations');

        if(!File::exists($migrationFolder)){
            File::makeDirectory($migrationFolder, 0755, true, true);
        }

        if(File::exists($migrationFolder)){
            $migrationFile = app_path('Console/Commands/Templates/Migration.txt');
            $migrationContent = File::get($migrationFile);
            $migrationContent = str_replace('{table}', strtolower($module), $migrationContent);
            $name = Carbon::now()->format('Y_m_d_His').'_'.$name;


            if(!File::exists($migrationFolder.'/'.$name.'.php')){
                File::put($migrationFolder.'/'.$name.'.php', $migrationContent);
                return $this->info('Migration created successfully');
            }
        }
        return $this->error('Base Folser Module Not Exists!');

    }
}
