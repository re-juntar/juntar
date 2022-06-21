<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Models\Event;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreEventController extends Controller
{

  public function index()
  {
    return view('pages.create-event');
  }

  public function store(ImageUploadRequest $request, Event $event)
  {
    // $request->validate([
    //   'name' => 'required|max:200|string',
    //   'short-name' => 'required|max:100|string',
    //   'description' => 'required',
    //   'place' => 'required|max:200|string',
    //   'category' => 'required',
    //   'modality' => 'required',
    //   'start-date' => 'required|before_or_equal:end-date',
    //   'end-date' => 'required',
    //   'logo' => 'required|mimes:jpeg,png,jpg',
    //   'flyer' => 'required|mimes:jpeg,png,jpg',
    //   'participants-limit' => 'required',
    //   'preinscription' => 'required',
    //   'acreditation-code' => 'required|string'
    // ]);

    $event->storeEvent($request)->storeMedia($request);
    // echo $paths;
    // $event->storeEvent($request, $paths);

    $response = Event::all()->where('event_status_id', 1);
    return redirect()->action([HomeController::class, 'filteredIndex']);
  }
}
