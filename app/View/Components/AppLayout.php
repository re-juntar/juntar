<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\PermissionController;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */

    public $permission;

    public function __construct(){
        $permissionController = new PermissionController();
        $this->permission = $permissionController->isAdmin();
    }

    public function render()
    {
        return view('layouts.app');
    }
}
