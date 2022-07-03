<?php

namespace App\Http\Livewire\Backend;

use App\Http\Controllers\PermissionController;
use Livewire\Component;

class BackLayout extends Component{

    public function render()
    {
        return view('layouts.back');
    }

    // public function __construct()
    // {
    //     $permissionController = new PermissionController();
    //     if($permissionController->isLogged()) {
    //         $admin = $permissionController->isAdmin();
    //         if($admin) {
    //             return $this->render();
    //         } else {
    //             return redirect('home');
    //         }
    //     } else {
    //         return ('login');
    //     }
    // }
}
