<?php

namespace App\Http\Controllers;

use App\Models\Organizer;

class OrganizerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($userId, $eventId)
    {
        $organizer = new Organizer();
        $organizer->user_id = $userId;
        $organizer->event_id = $eventId;

        $organizer->save();
    }
}
