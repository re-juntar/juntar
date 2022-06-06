<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <footer>
                <div class="container flex flex-col ">
                    <div>
                        <img class="w-80 h-20" src="{{asset('/images/logos/juntar-logo-w.svg')}}" alt="">
                    </div>

                    <div>
                        <h5>Juntar</h5>
                        <p>
                            Somos una plataforma web para gestión de eventos libre y
                            gratuita. El sitio permite a los usuarios navegar, crear y participar de eventos. Nació como un
                            desafío universitario y podemos asegurar que hemos llegado a la meta que teníamos como objetivo
                            e incluso la hemos superado gracias a un gran equipo de trabajo. Licencia GNU GPL version 3
                        </p>

                        <div>
                            <h5 class="white-text">Contacto</h5>
                            <a href="">Escribinos un mensaje</a>

                            <h5 class="white-text">Sobre Nosotros</h5>
                            <a href="">Sobre Nosotros</a>
                        </div>

                    </div>

                    <div>
                        <div>
                            Logo unco
                        </div>

                        <div>
                            Logo fai
                        </div>
                    </div>


                </div>
            </footer>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>