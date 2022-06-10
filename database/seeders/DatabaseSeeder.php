<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::factory(100)->create();
        \App\Models\Price::factory(50)->create();
        \App\Models\Sport::factory(100)->create();
        \App\Models\Image::factory(500)->create();


    }
}
