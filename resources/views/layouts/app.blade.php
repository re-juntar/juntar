<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Juntar') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased min-h-screen">
    <x-jet-banner />

    <div>
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($hero))
            {{ $hero }}
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        <footer class="bg-[#0B0D19] text-[#f8f9fa] pt-16">
            <div class="px-4 mx-auto max-w-6xl">
                <div class="flex flex-wrap -mx-4"> {{-- row --}}
                    <div class="relative w-100 px-4 py-[4vh] basis-2/5 max-w-[40%]"> {{-- col --}}
                        <img class="m-w-100 h-auto" src="{{ asset('/images/logos/juntar-logo-w.svg') }}" alt="">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-4"> {{-- row --}}
                    <div class="relative w-100 px-4 basis-4/6 max-w-[66%]"> {{-- col --}}
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
                    <div class="relative w-100 px-4 basis-4/12 max-w-[33%]"> {{-- col --}}
                        <div class="mt-6">
                            <h5 class="text-lg font-medium underline"><a href="">Contacto</a></h5>
                            {{-- <ul class="list-disc list-inside">
                                            <li>
                                                <a class="text-[#007bff]" href="">Escribinos un mensaje</a>
                                            </li>
                                        </ul> --}}
                            <h5 class="text-lg font-medium underline"><a href="">Sobre Nosotros</a></h5>
                            {{-- <ul class="list-disc list-inside">
                                            <li>
                                                <a class="text-[#007bff]" href="">Sobre Nosotros</a>
                                            </li>
                                        </ul> --}}
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-4 py-[3vh]"> {{-- row --}}
                    <div class="flex justify-center relative basis-1/2 max-w-[50%] py-4">
                        <img class="max-h-48" src="{{ asset('/images/logos/logo-uncoma-w.svg') }}" alt="">
                    </div>

                    <div class="flex justify-center relative basis-1/2 max-w-[50%] py-4">
                        <img class="max-h-48" src="{{ asset('/images/logos/logo-fai-w.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="text-left text-[#f8f9fa] bg-[#050714] py-4">
                <p class="px-4 mx-auto max-w-6xl">© Juntar 2022</p>
            </div>
        </footer>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
