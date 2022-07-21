<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\AcademicUnits;
use App\Http\Controllers\EventController;

class FrontHome extends Component
{
    use WithPagination;

    public function render(Request $request)
    {
        $eventController = new EventController();
        $events = $eventController->homeRequest($request);
        $academicUnits = AcademicUnits::all();
        return view('pages.front-home', ['events' => $events, 'academicUnits' => $academicUnits])->layout(\App\View\Components\AppLayout::class);
    }
}
