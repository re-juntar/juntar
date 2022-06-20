<?php

namespace App\Http\Controllers;

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

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|max:200|string',
      'short-name' => 'required|max:100|string',
      'description' => 'required',
      'place' => 'required|max:200|string',
      'category' => 'required',
      'modality' => 'required',
      'start-date' => 'required|before_or_equal:end-date',
      'end-date' => 'required',
      'logo' => 'required|image|mimes:jpeg,png,jpg',
      'flyer' => 'required|mimes:jpeg,png,jpg',
      'participants-limit' => 'required',
      'preinscription' => 'required',
      'acreditation-code' => 'required|string'
    ]);
  }
}
