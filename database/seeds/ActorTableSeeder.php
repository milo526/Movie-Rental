<?php

use Illuminate\Database\Seeder;

use App\Actor;

class ActorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actor::create( [
            'first_name' => 'Robert' ,
            'last_name' => 'Downey Jr.' ,
            'birthdate' => \Carbon\Carbon::createFromFormat('d/m/Y', '04/04/1965') ,
            'birth_country' => 'USA' ,
            'birth_province' => 'New York' ,
            'birth_city' => 'New York City',
        ] );

        Actor::create( [
            'first_name' => 'Chris' ,
            'last_name' => 'Evans' ,
            'birthdate' => \Carbon\Carbon::createFromFormat('d/m/Y', '13/06/1981') ,
            'birth_country' => 'USA' ,
            'birth_province' => 'Massachusetts' ,
            'birth_city' => 'Boston',
        ] );

        Actor::create( [
            'first_name' => 'Bradley' ,
            'last_name' => 'Cooper' ,
            'birthdate' => \Carbon\Carbon::createFromFormat('d/m/Y', '05/01/1975') ,
            'birth_country' => 'USA' ,
            'birth_province' => 'Pennsylvania' ,
            'birth_city' => 'Philadelphia',
        ] );

        Actor::create( [
            'first_name' => 'Chris' ,
            'last_name' => 'Pratt' ,
            'birthdate' => \Carbon\Carbon::createFromFormat('d/m/Y', '21/06/1979') ,
            'birth_country' => 'USA' ,
            'birth_province' => 'Minnesota' ,
            'birth_city' => 'Virginia',
        ] );
    }
}
