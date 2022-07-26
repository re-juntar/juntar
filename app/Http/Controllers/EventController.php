<?php

namespace App\Http\Controllers;

use App\Http\Livewire\FrontHome;
use App\Http\Requests\ImageUploadRequest;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventModality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = EventCategory::all();
        $modalities = EventModality::all();
        return view('pages.create-event', ['categories' => $categories, 'modalities' => $modalities]);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($eventId)
    {

        // $event = Event::find($eventoId);
        $event = Event::join('event_modalities', 'event_modalities.id', '=', 'events.event_modality_id')
            ->join('event_categories', 'event_categories.id', '=', 'events.event_category_id')
            ->join('event_statuses', 'event_statuses.id', '=', 'events.event_status_id')
            ->where('events.id', $eventId)
            ->get(['events.*', 'event_modalities.description as modality_description', 'event_categories.description as category_description', 'event_statuses.description as status_description'])[0];

        // $presentations = Presentation::where('event_id', $eventoId)->get();
        $organizer = $event->user;
        // $organizer = Event::join('users', 'users.id', '=', 'events.user_id')
        //     ->where('events.id', $eventoId)
        //     ->get(['users.name as user_name', 'users.surname as user_surname', 'users.email as user_email'])[0];

        $coorganizers = Event::join('organizers', 'organizers.event_id', '=', 'events.id')
            ->join('users', 'users.id', '=', 'organizers.user_id')
            ->where('events.id', $eventId)
            ->get(['users.name', 'users.surname']);

        $hasPermission = false;
        if (!is_null(Auth::user())) {
            $userId = Auth::user()->id;
            if ($userId == $event->user_id) {
                $hasPermission = true;
            }

            if (!$hasPermission && count($coorganizers) > 0) {
                foreach ($coorganizers as $coorganizer) {
                    if ($coorganizer->id == $userId) {
                        $hasPermission = true;
                    }
                }
            }
        }

        if (($event->status_description == "Draft" || $event->status_description == "Disabled") && !$hasPermission) {
            return redirect()->action(FrontHome::class);
        }

        return view('pages.events.evento', ['event' => $event, 'coorganizers' => $coorganizers, 'organizer' => $organizer, 'hasPermission' => $hasPermission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($eventId)
    {
        $event = Event::findOrfail($eventId);
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

        // if (isset($filter['order'])) {
        //     $order = $filter['order'];

        //     switch ($order) {
        //         case 'asc':
        //             $response = $response->orderBy('start_date', 'asc')->get();
        //             break;
        //         case 'desc':
        //             $response = $response->orderBy('start_date', 'desc')->get();
        //             break;
        //     }
        // }
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
