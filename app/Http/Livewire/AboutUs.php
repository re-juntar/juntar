<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AboutUs extends Component
{

    public $miembrosv2 = [
        'FDA' => [
            'nombre' => 'Federico Díaz Aimar',
            'redes' => [
                'github' => 'https://github.com/diazAimar',
                'linkedin' => 'https://www.linkedin.com/in/diazaimar/',
                'instagram' => 'https://www.instagram.com/'
            ],
            'imagen' => '',
        ],
        'a' => [
            'nombre' => 'a',
            'redes' => [
                'github' => 'https://github.com/diazAimar',
                'youtube' => 'https://www.youtube.com/'
            ],
            'imagen' => '',
        ],
        'b' => [
            'nombre' => 'b',
            'redes' => [
                'github' => 'https://github.com/diazAimar',
                'facebook' => 'https://www.facebook.com/'
            ],
            'imagen' => '',
        ],
        'c' => [
            'nombre' => 'c',
            'redes' => [
                'facebook' => 'https://www.facebook.com/',
                'twitter' => 'https://www.twitter.com/'
            ],
            'imagen' => '',
        ],
        'd' => [
            'nombre' => 'd',
            'redes' => [
                'github' => 'https://github.com/diazAimar',
                'linkedin' => 'https://www.linkedin.com/in/diazaimar/'
            ],
            'imagen' => '',
        ],
    ];

    public function render()
    {
        return view('livewire.about-us');
    }
}
