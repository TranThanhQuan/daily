<?php

namespace Modules\Groups\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Groups\src\Models\Groups;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Groups();
        $user->name = 'user';
        $user->title = 'Quản Lý Người Dùng';
        $user->save();
    }
}
