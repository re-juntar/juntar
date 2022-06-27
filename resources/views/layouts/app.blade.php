<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Juntar') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    {{-- jQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- autocomplete --}}
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js" defer></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.css') }}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if (Route::currentRouteName() == 'create-event')
        <script src={{ asset('/js/displayInputs.js/') }}></script>
        <link rel="stylesheet" href="{{ asset('vendor/ckeditor/contents.css') }}">
    @endif

    @if (Route::currentRouteName() == 'edit-event')
        <script src={{ asset('/js/displayInputsEdit.js/') }}></script>
        <link rel="stylesheet" href="{{ asset('vendor/ckeditor/contents.css') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('vendor/ckeditor/contents.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src={{ asset('/js/register.js') }} defer></script>
</head>

<body class="font-sans antialiased min-h-screen">
    <x-jet-banner />

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
                        <h5 class="text-lg font-medium underline"><a href="{{ route('contact') }}">Contacto</a></h5>
                        <h5 class="text-lg font-medium underline"><a href="{{ route('about-us') }}">Sobre
                                Nosotros</a>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="text-left text-white-ghost bg-fogra-dark py-4">
                <p class="px-4 mx-auto max-w-6xl"><i class="fa fa-copyright"></i> Juntar 2022</p>
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

    @stack('modals')

    @livewireScripts

    @if (isset($pageScripts))
        {{ $pageScripts }}
    @endif

</body>

</html>
