<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Juntar') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{asset('vendor/font-awesome/css/all.css')}}" rel="stylesheet">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased min-h-screen">
    <x-jet-banner />

    <div>
        @livewire('nav-bar', ['permission' => $permission])
        
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        <footer class="bg-fogra-darkish text-white-ghost pt-16">
            <div class="px-4 mx-auto max-w-6xl">
                <div class="flex flex-wrap -mx-4">
                    <div class="relative w-100 px-4 py-[4vh] max-w-xs md:basis-2/5 md:max-w-[40%]">
                        <img class="h-auto" src="{{ asset('/images/logos/juntar-logo-w.svg') }}" alt="">
                    </div>
                </div>
                <div class="flex flex-col flex-wrap content-center -mx-4 md:flex-row">
                    <div class="relative w-100 px-4 basis-4/6 max-w-[66%]">
                        <h5 class="text-xl font-medium">Juntar</h5>
                        <p class="text-lg">
                            Somos una plataforma web para gestión de eventos libre y
                            gratuita. El sitio permite a los usuarios navegar, crear y participar de eventos. Nació como
                            un
                            desafío universitario y podemos asegurar que hemos llegado a la meta que teníamos como
                            objetivo
                            e incluso la hemos superado gracias a un gran equipo de trabajo. Licencia GNU GPL version 3
                        </p>
                    </div>
                    <div class="relative w-100 px-4 basis-4/12 max-w-[33%]">
                        <div class="mt-6">
                            <h5 class="text-lg font-medium underline"><a href="{{route('contact')}}">Contacto</a></h5>
                            <h5 class="text-lg font-medium underline"><a href="{{route('about-us')}}">Sobre Nosotros</a></h5>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col flex-wrap content-center -mx-4 py-[3vh] md:flex-row">
                    <div class="flex justify-center relative basis-1/2 max-w-[50%] py-4">
                        <img class="max-h-48" src="{{ asset('/images/logos/logo-uncoma-w.svg') }}" alt="">
                    </div>

                    <div class="flex justify-center relative basis-1/2 max-w-[50%] py-4">
                        <img class="max-h-48" src="{{ asset('/images/logos/logo-fai-w.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="text-left text-white-ghost bg-fogra-dark py-4">
                <p class="px-4 mx-auto max-w-6xl">© Juntar 2022</p>
            </div>
        </footer>
    </div>

    @stack('modals')

    @livewireScripts

    @if (isset($pageScripts))
        {{ $pageScripts }}
    @endif
    
</body>

</html>