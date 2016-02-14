<?php

use Illuminate\Database\Seeder;

class Actor_MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('actor_movie')->insert([
        	'actor_id' => 3,
        	'movie_id' => 1,
    	]);

    	DB::table('actor_movie')->insert([
        	'actor_id' => 4,
        	'movie_id' => 1,
    	]);

    	DB::table('actor_movie')->insert([
        	'actor_id' => 4,
        	'movie_id' => 2,
    	]);

        DB::table('actor_movie')->insert([
        	'actor_id' => 1,
        	'movie_id' => 3,
    	]);

    	DB::table('actor_movie')->insert([
        	'actor_id' => 2,
        	'movie_id' => 3,
    	]);
    }
}
