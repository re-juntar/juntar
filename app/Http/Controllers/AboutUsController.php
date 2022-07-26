<?php

namespace App\Http\Controllers;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isAdmin = PermissionController::isAdmin();

        return view('pages.about-us', ['isAdmin' => $isAdmin]);
    }
}
