<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id) {
            $response = User::select('name', 'id', 'surname', 'email')->where('id', '<>', $request->id)->get();
        } else {
            $response = null;
        }
        return $response;
    }
}
