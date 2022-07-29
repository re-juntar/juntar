<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Http\Controllers\EventController;

class FrontHome extends Component
{
    use WithPagination;
    protected $listener = ['flyer'=>'openModal'];
    public $openFlyerModal = false;


    public function render(Request $request)
    {
        $eventController = new EventController();
        $events = $eventController->homeRequest($request);
        return view('pages.front-home', ['events' => $events])->layout(\App\View\Components\AppLayout::class);
    }

    public function openModal()
    {               
        $this->openFlyerModal = true;
    }
    
}
