<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Database\Factories\TaskFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $categories = ['Meeting Task','Meeting Normal','Meeting Agent'];
        foreach ($categories as $key=>$name){
            Category::create(['name'=>$name,'slug'=>Str::slug($name)]);
        }

       Task::factory(5)->create();

        User::create([
            'name' => 'mousa',
            'email'=>'mousa@hotmail.com',
            'password'=>bcrypt('password'),
        ]);
    }
}
