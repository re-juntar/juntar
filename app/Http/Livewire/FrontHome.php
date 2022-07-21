<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\AcademicUnits;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PermissionController;

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
