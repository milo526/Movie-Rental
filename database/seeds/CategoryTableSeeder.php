<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categories = ['Action', 'Adventure', 'Animation', 'Biography', 'Comedy', 'Crime', 'Drama', 'Family', 'Fantasy', 'Film-Noir', 'History', 'Horror', 'Music', 'Musical', 'Mystery', 'Romance', 'Sci-fi', 'Sport', 'Thriller', 'War', 'Western'];

    	foreach ($categories as $category) {
    		Category::create([
        		'name' => $category,
        	]);
    	}
    }
}
