<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($eventoId)
    {

        // $event = Event::find($eventoId);
        $event = Event::join('event_modalities', 'event_modalities.id', '=', 'events.event_modality_id')
            ->join('event_categories', 'event_categories.id', '=', 'events.event_category_id')
            ->join('event_statuses', 'event_statuses.id', '=', 'events.event_status_id')
            ->where('events.id', $eventoId)
            ->get(['events.*', 'event_modalities.description as modality_description', 'event_categories.description as category_description', 'event_statuses.description as status_description']);
        // $presentations = Presentation::where('event_id', $eventoId)->get();

        /*         $organizer = Event::join('users', 'users.id', '=', 'events.user_id')
            ->where('events.id', $eventoId)
            ->get(['users.name as user_name']); */

        $coorganizers = Event::join('organizers', 'organizers.event_id', '=', 'events.id')
            ->join('users', 'users.id', '=', 'organizers.user_id')
            ->where('events.id', $eventoId)
            ->get('users.*');
        return view('pages.events.evento', ['eventoId' => $eventoId, 'event' => $event, 'coorganizers' => $coorganizers]);
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
        return view('pages.edit-event', ['event' => $event, 'eventId' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // return back()->with('message', 'Lisiting update successfully!');

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

    public function specificRequest(Request $id)
    {
    }

    public function homeRequest(Request $filter)
    {
        if (isset($filter['search'])) {
            $search = $filter['search'];
            $response = Event::where('name', 'like', '%' . $search . '%')->where('event_status_id', '=', 1);
        } else {
            $response = Event::where('event_status_id', 1)->orderBy('start_date', 'asc')->get();
        }

        if (isset($filter['order'])) {
            $order = $filter['order'];

            switch ($order) {
                case 'asc':
                    $response = $response->orderBy('start_date', 'asc')->get();
                    break;
                case 'desc':
                    $response = $response->orderBy('start_date', 'desc')->get();
                    break;
            }
        }
        // } else {
        //     $response = $response->orderBy('start_date', 'asc');
        // }
        return $response;
    }
}
