<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

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

    public function filteredIndex(Request $request)
    {
        $permissionController = new PermissionController();
        $permission = $permissionController->isAdmin();
        $eventController = new EventController();
        $events = $eventController->homeRequest($request);

        $total = $events->count();
        $per_page = 25;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $response = $events->slice($starting_point, $per_page);

        $response = new Paginator($response, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        
        return view('pages.home', compact('response', 'permission'));
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
