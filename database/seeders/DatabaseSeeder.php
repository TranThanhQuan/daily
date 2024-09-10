<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
        {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            $groupId = DB::table('groups')->insertGetId([
                'name' => 'Administrator',
                'user_id' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            // tạo dữ liệu cho table users
            if($groupId > 0){
                $userId = DB::table('users')->insertGetId([
                    'name' => 'Nguyễn Văn A',
                    'email' => 'vana@gmail.com',
                    'password' => Hash::make('123456'),
                    'group_id' => $groupId,
                    'user_id' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

            // tạo dữ liệu cho table games
            if($userId > 0){
                DB::table('games')->insert([
                    'name' => 'ninja',
                    'user_id' => $userId,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

}
 