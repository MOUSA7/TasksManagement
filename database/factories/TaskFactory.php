<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description'=>$this->faker->sentence(20,true),
            'category_id'=>rand(1,3),
            'time'=> $this->faker->time('h:i:s'),
            'date'=> $this->faker->date('Y-m-d'),
        ];
    }
}
