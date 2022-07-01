<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{

    public function index()
    {
        //
    }

    /* public function store(ImageUploadRequest $request, Event $event)
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


        if ($event->storeEvent($request)->storeMedia($request)) {
            $eventId = Event::max('id');
            if (isset($request->coorganizer1)) {
                $orgController1 = new OrganizerController();
                $orgController1->store($request->coorganizer1, $eventId);
            }
        }
        return redirect()->action([HomeController::class, 'filteredIndex']);
    } */

    public function update(Request $request)
    {
        $eventCategory = EventCategory::find($request->id);
        if ($eventCategory) {
            $eventCategory->updateEventCategory($request);
            return redirect()->to('/gestionar/event-category');
        } else abort(409);
    }
}
