<?php

namespace App\Http\Livewire\Backend;

use App\Http\Controllers\PermissionController;
use Livewire\Component;

class BackHome extends Component
{
    public function render()
    {
        $permission = [];
        $permissionController = new PermissionController();
        if ($permissionController->isLogged()) {
            $permission = $permissionController->isAdmin();
            if ($permission['admin']) {
                return view('pages.backend.back-home')->layout('layouts.back');
                // return $this->render();
            } else {
                return view('home.front-home')->layout('layouts.app');
            }
        } else {
            return view('auth.login');
        }
    }

    // public function __construct()
    // {
    //     $permissionController = new PermissionController();
    //     if ($permissionController->isLogged()) {
    //         if ($permissionController->isAdmin()) {
    //             return $this->render();
    //         } else {
    //             return view('home');
    //         }
    //     } else {
    //         return 'login';
    //     }
    // }
}
