<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $filter = new Request();
        // $controller = new EventController();
        // $events = $controller->homeRequest($filter);

        // $events = $response->paginate(10);

        // return view('home', compact('events'));
    }

    public function filteredIndex(Request $filter)
    {
        $agent = new Agent();
        $controller = new EventController();
        $events = $controller->homeRequest($filter);
        $arr = collect([]);
        if($agent->isPhone()){
            $arr = $events->chunk(5);
        }elseif($agent->isTablet()){
            for($i=0; $i<3; $i++){
                $arr->push($events->nth(5, $i));
            }
        }else{
            for($i=0; $i<5; $i++){
                $arr->push($events->nth(5, $i));
            }
        }
        // $events = $response->paginate(10);
        return view('pages.home', compact('arr'));
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
        //
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
}
