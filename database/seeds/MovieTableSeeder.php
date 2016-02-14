<?php

use Illuminate\Database\Seeder;

use App\Movie;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::create([
        	'name' => 'Guardians of the Galaxy',
        	'release_date' =>\Carbon\Carbon::createFromFormat('d/m/Y', '14/08/2014') ,
        	'length' => 121,
        ]);

        Movie::create([
        	'name' => 'Jurassic World (2015)',
        	'release_date' =>\Carbon\Carbon::createFromFormat('d/m/Y', '11/06/2015') ,
        	'length' => 124,
        ]);

        Movie::create([
        	'name' => 'Avengers: Age of Ultron',
        	'release_date' =>\Carbon\Carbon::createFromFormat('d/m/Y', '22/04/2015') ,
        	'length' => 141,
        ]);
    }
}
