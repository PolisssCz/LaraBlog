<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostTags;

class PostTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostTags::factory()->times(200)->Create();
    }
}
