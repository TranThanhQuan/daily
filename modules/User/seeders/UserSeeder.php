<?php

namespace Modules\User\seeders;

use Illuminate\Database\Seeder;
use Modules\User\src\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Trần Thanh Quân';
        $user->email = 'quantranthanh153@gmail.com';
        $user->password = bcrypt('123456');
        $user->group_id = 1;
        $user->save();
    }
}
