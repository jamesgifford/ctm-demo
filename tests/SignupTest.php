<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class SignupTest extends TestCase
{
    /**
     * A user can signup with valid data
     *
     * @return void
     */
    public function testCanSignupWithValid()
    {
        $response = $this->call('POST', '/signups', [
            'email' => 'testemail1@email.com',
            'first_name' => 'testfirst',
            'last_name' => 'testlast',
            'opt_in' => 1
        ]);

        $response
            ->assertStatus(200);
    }

    /**
     * A user cannot signup with invalid data
     *
     * @return void
     */
    public function testCannotSignupWithInvalid()
    {
        $response = $this->call('POST', '/signups', [
            'email' => 'invalidemailaddress',
            'first_name' => 'testfirst',
            'last_name' => 'testlast',
            'opt_in' => 1
        ]);

        $response
            ->assertStatus(422);
    }

    /**
     * A user cannot signup with duplicate data
     *
     * @return void
     */
    public function testCannotSignupAgain()
    {
        $this->call('POST', '/signups', [
            'email' => 'testemail2@email.com',
            'first_name' => 'testfirst',
            'last_name' => 'testlast',
            'opt_in' => 1
        ]);

        $response = $this->call('POST', '/signups', [
            'email' => 'testemai2@email.com',
            'first_name' => 'testfirst',
            'last_name' => 'testlast',
            'opt_in' => 1
        ]);

        $response
            ->assertStatus(200);
    }

    /**
     * A user can update their signup with valid data
     *
     * @return void
     */
    public function testCanUpdateWithValid()
    {
        $response = $this->call('PUT', '/signups', [
            'email' => 'testemail1@email.com',
            'first_name' => 'testfirst',
            'last_name' => 'testlast',
            'opt_in' => 0
        ]);

        $response
            ->assertStatus(200);
    }

    /**
     * A user cannot update their signup with invalid data
     *
     * @return void
     */
    public function testCannotUpdateWithInvalid()
    {
        $response = $this->call('PUT', '/signups', [
            'email' => 'invalidemailaddress',
            'first_name' => 'testfirst',
            'last_name' => 'testlast',
            'opt_in' => 0
        ]);

        $response
            ->assertStatus(422);
    }
}
