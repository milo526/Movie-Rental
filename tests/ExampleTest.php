<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Login');

        $this->visit('/')
             ->click('Login')
             ->type('debug@localhost.local', 'email')
             ->type('test password', 'password')
             ->press('Login')
             ->click('Home')
             ->see('Test User');
    }
}
