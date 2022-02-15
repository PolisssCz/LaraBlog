<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(rand(15,30));
        $date = $this->faker->dateTimeBetween('-1000 day' );
        return [
            'user_id' => rand(1,  100),
            'title' => $title,
            'text' => $this->faker->paragraph(rand(30, 150)),
            'slug' =>  str::slug($title),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}


