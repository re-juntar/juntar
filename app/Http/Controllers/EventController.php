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
        /* $event = Event::findOrFail(1);
        return view('pages.edit-event',['event'=>$event]); */
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = event::findOrfail($id);
        return view('pages.edit-event',['event'=>$event]);
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
        //
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

    public function homeRequest(Request $filter)
    {
        if (isset($filter['search'])) {
            $search = $filter['search'];
            $response = Event::where('name', 'like', '%' . $search . '%');
        } else {
            $response = Event::all();
        }

        if (isset($filter['order'])) {
            $order = $filter['order'];

            switch ($order) {
                case 'asc':
                    $response = $response->orderBy('date', 'asc');
                    break;
                case 'desc':
                    $response = $response->orderBy('date', 'desc');
                    break;
            }
        } else {
            $response = $response->sortBy('date');
        }
        return $response;
    }
}
