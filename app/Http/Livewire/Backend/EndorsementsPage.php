<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\EndorsementRequest;
use Illuminate\Support\Facades\Auth;

class EndorsementsPage extends Component
{

    public $aval;

    public function render()
    {
        return view('pages.backend.endorsements')->layout('layouts.back');
    }

    public function store(Request $request){
        $id = Auth::user()->id;
        $aval = new EndorsementRequest();
        $aval->event_id = $request->eventId;
        $aval->academic_unit_id = $request->academicUnit;
        $aval->user_id = $id;
        $aval->save();

        return redirect()->to('/evento/'.$request->eventId);
    }
}
