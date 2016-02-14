<?php

use Illuminate\Database\Seeder;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create( [
            'email' => 'debug@localhost.local' ,
            'password' => Hash::make( 'test password' ) ,
            'name' => 'Test User' ,
        ] );
    }
}