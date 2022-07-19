<?php

namespace App\Http\Livewire\Backend;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\EndorsementRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermissionController;

class EndorsementsPage extends Component
{

    public $aval; 
    
    public function render()
    {
        $permission = [];
        $permissionController = new PermissionController();
        if ($permissionController->isLogged()) {
            $permission = $permissionController->isAdmin();
            if ($permission['admin']) {
                return view('pages.backend.endorsements')->layout('layouts.back');
            } else {
                $events = Event::paginate(25);
                return view('pages.front-home', ['events' => $events])->layout(\App\View\Components\AppLayout::class);
            }
        } else {
            return view('livewire.backend.login-back');
        }
    }

    public function store(Request $request){
        //dd($request->academicUnit);
        $id = Auth::user()->id;
        $aval = new EndorsementRequest();
        $solcAval = ['event_id'=>$request->eventId, 'academic_units_id' => $request->academicUnit, 'user_id' => $id];
        $aval->create($solcAval);

        return redirect()->to('/evento/'.$request->eventId);
    } 
}
