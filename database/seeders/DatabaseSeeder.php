<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
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

        $categories = ['Meeting Task','Meeting Normal'];
        foreach ($categories as $key=>$name){
            Category::create(['name'=>$name,'slug'=>Str::slug($name)]);
        }

        Task::create([
           'name' => 'First Task',
            'description'=>'Welcome To Description Content',
            'category_id'=>rand(1,3),
            'time'=> date('h:i:s'),
            'date'=> date(date(now())),
        ]);

        User::create([
            'name' => 'mousa',
            'email'=>'mousa@hotmail.com',
            'password'=>bcrypt('password'),
        ]);
    }
}
