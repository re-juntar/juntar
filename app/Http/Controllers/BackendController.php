<?php

namespace App\Http\Controllers;

use App\Http\Livewire\FrontHome;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function index()
    {
        $isAdmin = PermissionController::isAdmin();
        if ($isAdmin) {
            return view('layouts.back', ['isAdmin' => $isAdmin]);
        } else {
            return redirect('home');
        }
    }
}
