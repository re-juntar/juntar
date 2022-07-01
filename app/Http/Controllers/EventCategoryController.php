<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|max:100|string',
        ]);

        $eventCategory = new EventCategory();
        if ($eventCategory->store($request)) {
            return redirect()->to('/gestionar/event-category');
        } else abort(404);
    }

    public function update(Request $request)
    {
        $eventCategory = EventCategory::find($request->id);
        if ($eventCategory) {
            $eventCategory->updateEventCategory($request);
            return redirect()->to('/gestionar/event-category');
        } else abort(409);
    }
}
