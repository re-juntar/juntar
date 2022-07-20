<?php

namespace App\Http\Controllers;

use App\Http\Livewire\FrontHome;
use App\Http\Requests\ImageUploadRequest;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisssionController = new PermissionController();
        if ($permisssionController->isLogged()) {
            return view('pages.create-event');
        } else {
            return redirect('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageUploadRequest $request, Event $event)
    {
        $event->storeEvent($request)->storeMedia($request);
            $eventId = Event::max('id');
            if (isset($request->coorganizer1)) {
                $orgController1 = new OrganizerController();
                $user = User::where('email', '=', $request->coorganizer1)->first();
                $orgController1->store($user->id, $eventId);
            }

            if (isset($request->coorganizer2)) {
                $orgController2 = new OrganizerController();
                $user = User::where('email', '=', $request->coorganizer2)->first();
                $orgController2->store($user->id, $eventId);
            }

            if (isset($request->coorganizer3)) {
                $orgController3 = new OrganizerController();
                $user = User::where('email', '=', $request->coorganizer3)->first();
                $orgController3->store($user->id, $eventId);
            }
            return redirect('evento/' . $eventId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrfail($id);
        return view('pages.edit-event', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $event = Event::find($request->eventId);
        $event->updateEvent($request);
        return redirect()->action(FrontHome::class);
    }

    public function homeRequest($filter)
    {
        if (isset($filter['search'])) {
            $search = $filter['search'];
            $response = Event::where('name', 'like', '%' . $search . '%')
                ->where('event_status_id', '<>', 4)
                ->where('event_status_id', '<>', 2)
                ->orderBy('start_date', 'asc')
                ->paginate(25);
        } else {
            $response = Event::where('event_status_id', '<>', 4)->where('event_status_id', '<>', 2)->orderBy('start_date', 'asc')->paginate(25);
        }

        return $response;
    }

    public function myEvents()
    {
        $permisssionController = new PermissionController();
        if ($permisssionController->isLogged()) {
            return view('livewire.events');
        } else {
            return redirect('login');
        }
    }

    public function myInscriptions()
    {
        $permisssionController = new PermissionController();
        if ($permisssionController->isLogged()) {
            return view('livewire.my-inscriptions');
        } else {
            return redirect('login');
        }
    }
}
