<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AboutUsV1 extends Component
{

    public $params = [
        '0' => [
            'nombre' => 'name',
            'descripcion' => 'description',
            'link' => 'link',
            'isDev' => true
        ]
    ];

    public function render()
    {
        return view('livewire.about-us-v1');
    }
}
