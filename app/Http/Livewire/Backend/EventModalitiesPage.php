<?php

namespace App\Http\Livewire\Backend;

use App\Http\Controllers\PermissionController;
use App\Models\Event;
use Livewire\Component;

class EventModalitiesPage extends Component
{
  public function render()
  {
    return view('pages.backend.modalities')->layout('layouts.back');
  }
}
