<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function index()
    {
        $permissionController = new PermissionController();
        $permission = $permissionController->isAdmin();

        
        if ($permission['admin']) {
            return view('backend.gestionar', compact('permission'));
        } else {
            return redirect()->action([HomeController::class, 'filteredIndex']);
        }
    }
}
