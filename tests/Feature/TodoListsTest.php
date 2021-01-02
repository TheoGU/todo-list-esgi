<?php

namespace Tests\Feature;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Item\CreateNewItem;
use App\Actions\Todolist\CreateNewTodolist;
use App\Mail\MaximumItems;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class TodoListsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @return void
     */
    public function testFailedTwoLists()
    {
        $user = (new CreateNewUser())->create([
            'firstname' => 'Demo',
            'lastname' => 'Demo',
            'email' => $this->faker->unique()->safeEmail,
            'age' => 25,
            'password' => 'P@ssw0rd',
            'password_confirmation' => 'P@ssw0rd'
        ]);

        $this->actingAs($user);

        try {
            (new CreateNewTodolist())->create();
            (new CreateNewTodolist())->create();
        } catch (\Throwable $t) {
            $this->assertEquals('This action is unauthorized.', $t->getMessage());
        }
    }

    /**
     * @return void
     */
    public function testCreateNewItem()
    {
        $user = (new CreateNewUser())->create([
            'firstname' => 'Demo',
            'lastname' => 'Demo',
            'email' => $this->faker->unique()->safeEmail,
            'age' => 25,
            'password' => 'P@ssw0rd',
            'password_confirmation' => 'P@ssw0rd'
        ]);

        $this->actingAs($user);

        $list = (new CreateNewTodolist())->create();

        (new CreateNewItem())->create([
            'label' => $this->faker->sentence,
            'contenu' => $this->faker->sentence,
        ], $list);

        $this->assertDatabaseHas('items', [
           'todo_list_id' => $list->id
        ]);
    }

    /**
     * @return void
     */
    public function testFailedTwoItems()
    {
        $user = (new CreateNewUser())->create([
            'firstname' => 'Demo',
            'lastname' => 'Demo',
            'email' => $this->faker->unique()->safeEmail,
            'age' => 25,
            'password' => 'P@ssw0rd',
            'password_confirmation' => 'P@ssw0rd'
        ]);

        $this->actingAs($user);

        $list = (new CreateNewTodolist())->create();

        (new CreateNewItem())->create([
            'label' => $this->faker->sentence,
            'contenu' => $this->faker->sentence,
        ], $list);

        try {
            (new CreateNewItem())->create([
                'label' => $this->faker->sentence,
                'contenu' => $this->faker->sentence,
            ], $list);
        } catch (\Exception $e) {
            $this->assertEquals('This action is unauthorized.', $e->getMessage());
        }
    }


    /**
     * @return void
     */
    public function testEmail()
    {
        Mail::fake();

        $user = (new CreateNewUser())->create([
            'firstname' => 'Demo',
            'lastname' => 'Demo',
            'email' => $this->faker->unique()->safeEmail,
            'age' => 25,
            'password' => 'P@ssw0rd',
            'password_confirmation' => 'P@ssw0rd'
        ]);

        $this->actingAs($user);

        $list = (new CreateNewTodolist())->create();

        for ($i = 1; $i < 10; $i++) {
            (new CreateNewItem())->create([
                'label' => $this->faker->sentence,
                'contenu' => $this->faker->sentence,
                'created_at' => now()->addMinutes($i * 30 + 1)
            ], $list);
        }

        Mail::assertSent(MaximumItems::class);
    }

    /**
     * @return void
     */
    public function testInvalidTask()
    {
        $user = (new CreateNewUser())->create([
            'firstname' => 'Demo',
            'lastname' => 'Demo',
            'email' => $this->faker->unique()->safeEmail,
            'age' => 25,
            'password' => 'P@ssw0rd',
            'password_confirmation' => 'P@ssw0rd'
        ]);

        $this->actingAs($user);

        $list = (new CreateNewTodolist())->create();

        try {
            (new CreateNewItem())->create([
                'label' => $this->faker->sentence,
                'contenu' => '',
            ], $list);

        } catch (\Exception $e) {
            $this->assertEquals('The given data was invalid.', $e->getMessage());
        }
    }

    /**
     * @return void
     */
    public function testCreateTodolist()
    {
        $user = (new CreateNewUser())->create([
            'firstname' => 'Demo',
            'lastname' => 'Demo',
            'email' => $this->faker->unique()->safeEmail,
            'age' => 25,
            'password' => 'P@ssw0rd',
            'password_confirmation' => 'P@ssw0rd'
        ]);

        $this->actingAs($user);

        (new CreateNewTodolist())->create();

        $this->assertDatabaseHas('todo_lists', [
            'user_id' => $user->id
        ]);
    }
}
