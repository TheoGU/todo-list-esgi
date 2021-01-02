<?php

namespace Tests\Feature;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Test for the creation of a valid user
     *
     * @return void
     */
    public function testCreateValidUser()
    {
        $email = $this->faker->unique()->safeEmail;

        (new CreateNewUser())->create([
            'firstname' => 'Test',
            'lastname' => 'Test2',
            'age' => 21,
            'email' => $email,
            'password' => 'Azerty1234',
            'password_confirmation' => 'Azerty1234'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $email
        ]);
    }

    /**
     * Test for the creation of an invalid user with invalid email
     */
    public function testCantCreateInvalidEmail()
    {
        $email = 'wrong-email-format';

        try {
            (new CreateNewUser())->create([
                'firstname' => 'Test',
                'lastname' => 'Test2',
                'age' => 12,
                'email' => $email,
                'password' => 'Azerty1234',
                'password_confirmation' => 'Azerty1234'
            ]);

        } catch (\Throwable $t) {
            $this->assertInstanceOf('Illuminate\Validation\ValidationException', $t);
        }
    }

    /**
     * Test for the creation of an invalid user with invalid age
     */
    public function testCantCreateInvalidAge()
    {
        $email = $this->faker->unique()->safeEmail;

        try {
            (new CreateNewUser())->create([
                'firstname' => 'Test',
                'lastname' => 'Test2',
                'age' => 12,
                'email' => $email,
                'password' => 'Azerty1234',
                'password_confirmation' => 'Azerty1234'
            ]);

        } catch (\Throwable $t) {
            $this->assertInstanceOf('Illuminate\Validation\ValidationException', $t);
        }
    }

    /**
     * Test for the creation of an invalid user with invalid password
     */
    public function testCantCreateInvalidPassword()
    {
        $email = $this->faker->unique()->safeEmail;

        try {
            (new CreateNewUser())->create([
                'firstname' => 'Test',
                'lastname' => 'Test2',
                'age' => 18,
                'email' => $email,
                'password' => 'A',
                'password_confirmation' => 'A'
            ]);

        } catch (\Throwable $t) {
            $this->assertInstanceOf('Illuminate\Validation\ValidationException', $t);
        }
    }
}
