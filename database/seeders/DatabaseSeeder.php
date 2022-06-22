<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
            [
                'role' => 'Admin',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'role' => 'Chủ Sport',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'role' => 'User',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
        ]);
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'role_id' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'nguyenson1',
                'username' => 'nguyenson1',
                'password' => bcrypt('123456'),
                'role_id' => 2,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'nguyenson2',
                'username' => 'nguyenson2',
                'password' => bcrypt('123456'),
                'role_id' => 2,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
        ]);
        \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            [
                'name' => 'user1',
                'username' => 'user1',
                'password' => bcrypt('123456'),
                'role_id' => 3,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'user2',
                'username' => 'user2',
                'password' => bcrypt('123456'),
                'role_id' => 3,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'user3',
                'username' => 'user3',
                'password' => bcrypt('123456'),
                'role_id' => 3,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
        ]);
        \App\Models\Category::factory(100)->create();
        \App\Models\Price::factory(50)->create();
        \App\Models\Sport::factory(100)->create();
        \App\Models\Image::factory(500)->create();
    }
}
