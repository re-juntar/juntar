<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Http\Requests\ImageUploadRequest;
use App\Models\EventCategory;
use App\Models\EventModality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermissionController;
use App\Models\Organizer;

class EventController extends Controller
{
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = EventCategory::all();
        $modalities = EventModality::all();
        $coorganizers = Organizer::where('event_id', '=', $id)
            ->join('users', 'users.id', '=', 'organizers.user_id')
            ->get();
        $event = Event::findOrfail($id);
        if (isset(Auth::user()->id) && Auth::user()->id == $event->user_id) {
            list($startDateDay, $startDateMonth, $startDateYear) = explode("-", $event->start_date);
            $formatedInscriptionEndDate = "";
            list($endDateDay, $endDateMonth, $endDateYear) = explode("-", $event->end_date);
            if(isset($event->inscription_end_date)){
                list($inscriptionEndDateDay, $inscriptionEndDateMonth, $inscriptionEndDateYear) = explode("-", $event->inscription_end_date);
                $formatedInscriptionEndDate = $inscriptionEndDateYear . '-' . $inscriptionEndDateMonth . '-' . $inscriptionEndDateDay;
            } else {
                $formatedInscriptionEndDate = $event->inscription_end_date;
            }
            $formatedStartDate = $startDateYear . '-' . $startDateMonth . '-' . $startDateDay;
            $formatedEndDate = $endDateYear . '-' . $endDateMonth . '-' . $endDateDay;

            return view('pages.edit-event', ['event' => $event, 'formatedStartDate' => $formatedStartDate, 'formatedEndDate' => $formatedEndDate,  'formatedInscriptionEndDate' => $formatedInscriptionEndDate, 'categories' => $categories, 'modalities' => $modalities, 'coorganizers' => $coorganizers]);

        } else {
            abort(403);
        }
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
        $coorganizers = Organizer::where('event_id', '=', $request->eventId)
            ->join('users', 'users.id', '=', 'organizers.user_id')
            ->get();
        $totalCoorganizers = count($coorganizers);
        if ($totalCoorganizers < 3) {
            if (isset($request->coorganizer1)) {
                $orgController1 = new OrganizerController();
                $user = User::where('email', '=', $request->coorganizer1)->first();
                $arrIsCoorganizer1 = Organizer::where('event_id', '=', $request->eventId)
                    ->join('users', 'users.id', '=', 'organizers.user_id')
                    ->where('users.id', '=', $user->id)
                    ->get();
                if (count($arrIsCoorganizer1) == 0 && $totalCoorganizers < 3) {
                    $orgController1->store($user->id, $request->eventId);
                    $totalCoorganizers++;
                }
            }

            if (isset($request->coorganizer2)) {
                $orgController2 = new OrganizerController();
                $user = User::where('email', '=', $request->coorganizer2)->first();
                $arrIsCoorganizer2 = Organizer::where('event_id', '=', $request->eventId)
                    ->join('users', 'users.id', '=', 'organizers.user_id')
                    ->where('users.id', '=', $user->id)
                    ->get();
                if (count($arrIsCoorganizer2) == 0 && $totalCoorganizers < 3) {
                    $orgController2->store($user->id, $request->eventId);
                }
            }

            if (isset($request->coorganizer3)) {
                $orgController3 = new OrganizerController();
                $user = User::where('email', '=', $request->coorganizer3)->first();
                $arrIsCoorganizer3 = Organizer::where('event_id', '=', $request->eventId)
                    ->join('users', 'users.id', '=', 'organizers.user_id')
                    ->where('users.id', '=', $user->id)
                    ->get();
                if (count($arrIsCoorganizer3) == 0 && $totalCoorganizers < 3) {
                    $orgController3->store($user->id, $request->eventId);
                }
            }
        }
        $event->updateEvent($request);
        return redirect(route('evento', $request->eventId));
    }

    public function deleteCoorganizer($eventId, $coorganizerId)
    {
        $event = Event::findOrFail($eventId);
        if (!is_null(Auth::user()) && Auth::user()->id == $event->user_id) {
            Organizer::where('event_id', '=', $eventId)
                ->join('users', 'users.id', '=', 'organizers.user_id')
                ->where('organizers.user_id', '=', $coorganizerId)
                ->delete();
            return redirect(route('edit-event', $eventId));
        } else abort(403);
    }

    public function homeRequest($filter)
    {
        if (isset($filter['search'])) {
            $search = $filter['search'];
            $response = Event::where('name', 'like', '%' . $search . '%')
                ->where('event_status_id', '<>', 4)
                ->where('event_status_id', '<>', 2)
                ->orderBy('start_date', 'desc')
                ->paginate(25);
        }elseif (isset($filter['filter1'])) {
            $response = Event::where('event_modality_id', '=', 1)
                ->where('event_status_id', '<>', 4)
                ->where('event_status_id', '<>', 2)
                ->orderBy('start_date', 'desc')
                ->paginate(25);
        }elseif (isset($filter['filter2'])) {
            $response = Event::where('event_modality_id', '=', 2)
                ->where('event_status_id', '<>', 4)
                ->where('event_status_id', '<>', 2)
                ->orderBy('start_date', 'desc')
                ->paginate(25);
        }
        elseif (isset($filter['filter3'])) {
            $response = Event::where('event_modality_id', '=', 3 )
                ->where('event_status_id', '<>', 4)
                ->where('event_status_id', '<>', 2)
                ->orderBy('start_date', 'desc')
                ->paginate(25);
        }
        elseif (isset($filter['filter4'])) {
            $response = Event::where('event_modality_id', '=', 4 )
                ->where('event_status_id', '<>', 4)
                ->where('event_status_id', '<>', 2)
                ->orderBy('start_date', 'desc')
                ->paginate(25);
        } else {
            $response = Event::where('event_status_id', '<>', 4)->where('event_status_id', '<>', 2)->orderBy('start_date', 'desc')->paginate(25);
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

        return view('livewire.my-inscriptions');
    }
}
