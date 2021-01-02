<?php

namespace App\Policies;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodolistPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->todolists()->count() < 1;
    }

    public function createItem(User $user, TodoList $todoList)
    {
        if ($todoList->items()->count() >= 10) {
            return false;
        }

        if ($todoList->items()->latest()->exists()) {
            $now = now();
            if (30 > $todoList->items()->latest()->first()->created_at->diffInMinutes($now) && $todoList->items()->latest()->first()) {
                return false;
            }
        }

        return true;
    }
}
