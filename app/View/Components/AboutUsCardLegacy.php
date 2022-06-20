<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AboutUsCardLegacy extends Component
{
    public $miembro;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($miembro)
    {
        $this->miembro = $miembro;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.about-us-card-legacy');
    }
}
