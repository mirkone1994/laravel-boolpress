<?php

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Category;
use Illuminate\Support\Arr;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories_id = Category::select('id')->pluck('id')->toArray();
        
        for($i = 0; $i < 50; $i++){
            $post = new Post();
            $post->category_id = Arr::random($categories_id);
            $post->title = $faker->text(50);
            $post->content = $faker->paragraphs(2, true);
            $post->image = $faker->imageUrl(360, 360);
            $post->slug = Str::slug($post->title, '-');
            $post->save();
        }
    }
}
