<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PostTags;
use App\Models\Post;
use App\Models\Tag;

class PostTagsFactory extends Factory
{
        /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostTags::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $post = Post::all()->count();
        $tag = Tag::all()->count();
        return [
            'post_id' => rand(1, $post),
            'tag_id' => rand(1, $tag),
        ];
    }
}
