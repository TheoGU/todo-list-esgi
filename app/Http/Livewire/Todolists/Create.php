<?php

namespace App\Http\Livewire\Todolists;

use Livewire\Component;

class Create extends Component
{
    public $title;

    public $description;

    public function render()
    {
        return view('livewire.todolists.create');
    }

    public function store()
    {
        //
    }
}
