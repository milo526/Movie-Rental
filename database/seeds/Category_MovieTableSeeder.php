<?php

use Illuminate\Database\Seeder;

class Category_MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_movie')->insert([
        	'category_id' => 1,
        	'movie_id' => 1,
    	]);

    	DB::table('category_movie')->insert([
        	'category_id' => 2,
        	'movie_id' => 1,
    	]);

    	DB::table('category_movie')->insert([
        	'category_id' => 17,
        	'movie_id' => 1,
    	]);

    	DB::table('category_movie')->insert([
        	'category_id' => 1,
        	'movie_id' => 2,
    	]);

    	DB::table('category_movie')->insert([
        	'category_id' => 2,
        	'movie_id' => 2,
    	]);

    	DB::table('category_movie')->insert([
        	'category_id' => 17,
        	'movie_id' => 2,
    	]);

    	DB::table('category_movie')->insert([
        	'category_id' => 1,
        	'movie_id' => 3,
    	]);

    	DB::table('category_movie')->insert([
        	'category_id' => 2,
        	'movie_id' => 3,
    	]);

    	DB::table('category_movie')->insert([
        	'category_id' => 17,
        	'movie_id' => 3,
    	]);
    }
}
