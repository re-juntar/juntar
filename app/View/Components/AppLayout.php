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

    public $isAdmin;
    public $isValidator;

    public function __construct(){
        $permissionController = new PermissionController();
        $this->isAdmin = $permissionController->isAdmin();
        $this->isValidator = $permissionController->isValidator();
    }

    public function render()
    {
        return view('layouts.app');
    }
}
