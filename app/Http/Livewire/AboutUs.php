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
                'github' => 'https://github.com/santiagoScantamburlo',
                'linkedin' => 'https://www.linkedin.com/in/santiago-scantamburlo/',
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
                'user' => 'https://portfolio-rcardozo.web.app/home'
            ],
            'image' => 'RC',
        ],
        [
            'name' => 'Francisco Rubilar',
            'socials' => [
                'github' => 'https://github.com/frubilar1986',
                'envelope' => 'francisco.rubilar@est.fi.uncoma.edu.ar',
            ],
            'image' => 'FR',
        ],
        [
            'name' => 'Santiago Lubary',
            'socials' => [
                'github' => 'https://github.com/SaniLubary',
                'linkedin' => 'https://www.linkedin.com/in/santi-lubary/',
                'envelope' => 'santiago.lp.cop@gmail.com'
            ],
            'image' => 'SL',
        ],
        [
            'name' => 'Cristian Garrado',
            'socials' => [
                'github' => 'https://github.com/cristian96-code',
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
                'envelope' => 'juan@moramarcos.com.ar',
                'instagram' => 'https://www.instagram.com/jotaweb/',
                'user' => 'https://jotaweb.com.ar/'
            ],
            'image' => 'JJM',
        ],
        [
            'name' => 'Santiago Avilez Ariza',
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
            ],
            'image' => 'JEH',
        ],
        [
            'name' => 'Adriana Fabiola Leiva',
            'socials' => [
                'github' => 'https://github.com/adri-leiva',
                'linkedin' => 'https://www.linkedin.com/in/adriana-leiva/',
                'envelope' => 'adriana.leiva@est.fi.uncoma.edu.ar',
            ],
            'image' => 'AFL',
        ]
    ];

    public function render()
    {
        return view('livewire.about-us');
    }
}
