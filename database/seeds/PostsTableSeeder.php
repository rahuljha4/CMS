<?php

use App\Post;
use App\Category;
use App\Tag;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = App\User::create([
            'name' => 'Jhon Doe',
            'email' => 'jhonDoe@gmail.com',
            'password' => Hash::make('password')
        ]);

        $author2 = App\User::create([
            'name' => 'Keshav Jha',
            'email' => 'keshavJha@gmail.com',
            'password' => Hash::make('password')
        ]);

        $category1 = Category::create([
            'name' => 'News'
        ]);

        $category2 = Category::create([
            'name' => 'Marketing'
        ]);

        $category3 = Category::create([
            'name' => 'Partnership'
        ]);

        $post1 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'We relocated our office to a new designed garage',
            'content' => 'We relocated our office to a new designed garage',
            'category_id' => $category1->id,
            'image' => 'posts/1.jpg',
            'user_id' => $author1->id
        ]);

        $post2 = Post::create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'Top 5 brilliant content marketing strategies',
            'content' => 'Top 5 brilliant content marketing strategies',
            'category_id' => $category2->id,
            'image' => 'posts/2.jpg',
            'user_id' => $author2->id
        ]);

        $post3 = Post::create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'Best practices for minimalist design with example',
            'content' => 'Best practices for minimalist design with example',
            'category_id' => $category3->id,
            'image' => 'posts/3.jpg',
            'user_id' => $author1->id
        ]);

        $post4 = Post::create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'Congratulate and thank to Maryam for joining our team',
            'content' => 'Congratulate and thank to Maryam for joining our team',
            'category_id' => $category1->id,
            'image' => 'posts/4.jpg',
            'user_id' => $author2->id
        ]);

        $tag1 = Tag::create([
            'name' => 'Record'
        ]);

        $tag2 = Tag::create([
            'name' => 'Progress'
        ]);

        $tag3 = Tag::create([
            'name' => 'Customers'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag3->id, $tag1->id]);
        $post4->tags()->attach([$tag1->id, $tag3->id]);
    }
}
