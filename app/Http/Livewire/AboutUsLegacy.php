<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AboutUsLegacy extends Component
{

    public $miembros = [
        'DC' => [
            'nombre' => 'Damián Cabrio',
            'mensajes' => [
                'Si encuentran algún error, yo no fui..',
                'Pase días haciendo los formularios dinámicos, espero que les gusten.',
                'Si estás leyendo esto, espero que tengas un lindo día.',
                'Si nosotros pudimos, todos pueden.',
                'Hola persona del futuro, ¿Cómo te va?'
            ],
            'link' => 'https://github.com/DamianCabrio',
            'isDev' => true
        ],
        'FB' => [
            'nombre' => 'Felipe Bastidas',
            'mensajes' => [
                'Yii Modales tiene modales',
                'Me dijeron que era único, pero nunca me validaron',
                'Más allá del bien y del mal.',
                'Smile while it\'s free :-)',
                'Si no funcionó con un foreach, puede que funcione con dos',
                'Fixer nocturno',
                'Me llama usted, entonces voy. Don Yii Modales es quien yo soy',
                'O sea sí. Pero no.',
                'Tienes que hacerlo por mi Pipo, por Yii Modales',
                'Cuatro lineas más y termino el código..',
                'OIGA! Estoy tratando de terminar mi código espaguetti.',
            ],
            'link' => '',
            'isDev' => true
        ],
        'LC' => [
            'nombre' => 'Leandro Casanova',
            'mensajes' => [
                'Señor ssh master. Permisos usuarios, log in y más.',
            ],
            'link' => '',
            'isDev' => true
        ],
        'NS' => [
            'nombre' => 'Norbert Stange',
            'mensajes' => [
                'We aim above the mark to hit the mark.',
                'Ich esse gern Brot mit warmem Käse.',
                '私はビールを飲み、チップを食べるのが好きです。',
            ],
            'link' => 'mailto:norbert@stange.com.ar',
            'isDev' => true
        ],
        'EA' => [
            'nombre' => 'Emanuel Araya',
            'mensajes' => [
                'Metimos cuchara en verEvento.php',
            ],
            'link' => '',
            'isDev' => true
        ],
        'LM' => [
            'nombre' => 'Laura Murillo',
            'mensajes' => [
                'Este es el resultado de muchas noches de desvelo.',
                'Este equipo es lo más. ',
                'Programado 100% en modo remoto - casita.',
                '¿Sabes todo el helado que necesité para hacer este proyecto?',
                'Nunca dudes de un grupo de entusiastas.',
                '¡Proyecto exitoso realizado en cuarentena!.',
            ],
            'link' => 'mailto:lauradejaramillo@gmail.com',
            'isDev' => true
        ],
        'MB' => [
            'nombre' => 'Marcos Benitez',
            'mensajes' => [
                'Metimos cuchara en verEvento.php',
            ],
            'link' => '',
            'isDev' => true
        ],
        'MS' => [
            'nombre' => 'Mauro Saracini',
            'mensajes' => [
                'Metimos cuchara en verEvento.php',
            ],
            'link' => '',
            'isDev' => true
        ],
        'MB2' => [
            'nombre' => 'Maxi Bajamón',
            'mensajes' => [
                'A la grande le puse Cuca',
            ],
            'link' => '',
            'isDev' => true
        ],
        'KE' => [
            'nombre' => 'Kevin Espinoza',
            'mensajes' => [
                'omae wa mou shindeiru',
                'Mira mamá!!! Aparezco en los créditos :D',
                '¿En cuántos proyectos universitarios ves algo así de genial?',
                'Me miraba 3 o 4 videos en YouTube antes de ponerme a programar (?',
                'Si jugás al League of Legends, agregame: \'Mekuru\' (LAS)',
            ],
            'link' => 'https://www.instagram.com/kevin_esp_/',
            'isDev' => true
        ],
    ];

    public $profesoras = [
        'NB' => [
            'nombre' => 'Natalia Baeza',
            'mensajes' => [
                'Profesora Cátedra PWA - 2020',
            ],
            'link' => '',
            'isDev' => false
        ],
        'VZ' => [
            'nombre' => 'Valeria Zoratto',
            'mensajes' => [
                'Profesora Cátedra PWA - 2020',
            ],
            'link' => '',
            'isDev' => false
        ],
    ];

    public function randomize_members($arr)
    {
        $keys = array_keys($arr);

        shuffle($keys);

        foreach ($keys as $key) {
            $new[$key] = $arr[$key];
        }

        $arr = $new;

        return $arr;
    }

    public function render()
    {
        return view('livewire.about-us-legacy');
    }
}
