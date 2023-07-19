<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class Dev extends Component
{

    public $count = 0;
    public $searsh = '';

    public function render()
    {
        return view('livewire.dev', [
            'users' => User::where('name', $this->searsh)->get()
        ]);
    }

    public function Increment()
    {
        $this->count++;
    }

    public function Decrement()
    {
        $this->count--;
    }
}
