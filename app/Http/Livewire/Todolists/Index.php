<?php

namespace App\Http\Livewire\Todolists;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\TodoList;

class Index extends Component
{
    public $todolists;

    public function mount()
    {
        /** @var User $user */
        $user = Auth::user();

        $this->todolists = $user->todolists;
    }

    public function render()
    {
        return view('livewire.todolists.index');
    }
}
