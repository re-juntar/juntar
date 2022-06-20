<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inscription;

class Events extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.my-event-inscription', ['eventos' => Inscription::paginate(5)]);
    }
    public function a()
    {
        return 'livewire.my-event-inscription';
    }
}