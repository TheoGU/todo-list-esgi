<?php

namespace App\Actions\Item;

use App\Mail\MaximumItems;
use App\Models\Item;
use App\Models\TodoList;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CreateNewItem
{
    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @param TodoList $todoList
     * @return \App\Models\Item
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(array $input, TodoList $todoList)
    {
        Gate::authorize('createItem', $todoList);

        Validator::make($input, [
            'label' => ['required', 'unique:items', 'max:255'],
            'contenu' => ['required', 'max:1000']
        ])->validate();

        $item = new Item;
        $item->todo_list_id = $todoList->id;
        $item->label = $input['label'];
        $item->contenu = $input['contenu'];
        $item->created_at = $input['created_at'] ?? now();
        $item->save();


        if ($todoList->items()->count() === 8) {
            Mail::to(auth()->user())->send(new MaximumItems($todoList));
        }

        return $item;
    }
}
