<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->insert([
            [
            'user_id' => '9',
            'post' => '1つ目の投稿になります',
            ],
        ]);
    }
}
