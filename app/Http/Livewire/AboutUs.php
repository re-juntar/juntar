<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AboutUs extends Component
{

    public $miembrosv2 = [
        [
            'name' => 'Federico Díaz Aimar',
            'socials' => [
                'github' => 'https://github.com/diazAimar',
                'linkedin' => 'https://www.linkedin.com/in/diazaimar/',
                'envelope' => 'fede2804@hotmail.com'
            ],
            'image' => 'FDA',
        ],
        [
            'name' => 'Juan Marcos Gonzalez',
            'socials' => [
                'github' => 'https://github.com/jmarcosg',
                'linkedin' => 'https://www.linkedin.com/in/jmarcosg/',
                'envelope' => 'jmarcos.gonzalez94@gmail.com'
            ],
            'image' => 'JMG',
        ],
        [
            'name' => 'Santiago Scantamburlo',
            'socials' => [
                'linkedin' => 'https://www.linkedin.com/in/santiago-scantamburlo/',
                'github' => 'https://github.com/santiagoScantamburlo',
                'envelope' => 'santiagosca@outlook.com'
            ],
            'image' => 'SS',
        ],
        [
            'name' => 'Ramiro Cardozo',
            'socials' => [
                'github' => 'https://github.com/Raam4',
                'linkedin' => 'https://www.linkedin.com/in/ramiro-cardozo-1504/',
                'envelope' => 'ramiro_cardozo22@hotmail.com',
                'user' => 'Ramiro Cardozo - Portfolio'
            ],
            'image' => 'RC',
        ],
        [
            'name' => 'Francisco Rubilar',
            'socials' => [
                'github' => 'frubilar1986',
                'envelope' => 'francisco.rubilar@est.fi.uncoma.edu.ar',
            ],
            'image' => 'FR',
        ],
        [
            'name' => 'Santi Lubary',
            'socials' => [
                'github' => 'https://github.com/SaniLubary',
                'linkedin' => 'https://www.linkedin.com/in/santi-lubary/',
                'envelope' => 'santiago.lp.cop@gmail.com'
            ],
        ],
        [
            'name' => 'Cristian Garrado',
            'socials' => [
                'github' => 'cristian96-https://github.com/code',
                'linkedin' => 'https://www.linkedin.com/in/cristian-garrado-517a23209/',
                'envelope' => 'cristiangarrado45@gmail.com',
            ],
            'image' => 'CG',
        ],
        [
            'name' => 'Juan Julian Mora',
            'socials' => [
                'github' => 'https://github.com/jotanqn',
                'linkedin' => 'https://www.linkedin.com/in/juan-julian-mora-marcos/',
                'instagram' => 'https://www.instagram.com/jotaweb/',
                'envelope' => 'juan@moramarcos.com.ar',
                'user' => 'jotaweb.com.ar'
            ],
            'image' => 'JJM',
        ],
        [
            'name' => 'Santiago Avilez',
            'socials' => [
                'github' => 'https://github.com/santiagoavilez',
                'linkedin' => 'https://www.linkedin.com/in/santiago-avilez-ariza-431b5a203/',
                'envelope' => 'santiago.avilez@est.fi.uncoma.edu.ar',
            ],
            'image' => 'SA',
        ],
        [
            'name' => 'Juan Elias Henriquez',
            'socials' => [
                'github' => 'https://github.com/jehenriquez',
                'envelope' => 'juan.henriquez@est.fi.uncoma.edu.ar'
            ]
        ]
    ];

    public function render()
    {
        return view('livewire.about-us');
    }
}
