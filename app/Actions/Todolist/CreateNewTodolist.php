<?php

namespace App\Actions\Todolist;

use App\Models\TodoList;
use Illuminate\Support\Facades\Gate;

class CreateNewTodolist
{
    /**
     * Validate and create a newly registered user.
     *
     * @return \App\Models\TodoList
     */
    public function create()
    {
        Gate::authorize('create', TodoList::class);

        return TodoList::create([
            'user_id' => auth()->id()
        ]);
    }
}
