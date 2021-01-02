<?php

namespace App\Mail;

use App\Models\TodoList;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MaximumItems extends Mailable
{
    use Queueable, SerializesModels;

    private TodoList $todolist;

    /**
     * Create a new message instance.
     *
     * @param TodoList $todoList
     */
    public function __construct(TodoList $todoList)
    {
        $this->todolist = $todoList;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.max');
    }
}
