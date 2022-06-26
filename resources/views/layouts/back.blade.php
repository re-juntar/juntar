<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gestionar') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased min-h-screen">
    <x-jet-banner />

    @livewire('backend.side-nav')

    <!-- Page Content -->
    <main class="mt-3">
        <div class="">
            <x-card class="text-white-ghost max-w-7xl mx-auto">
                {{--<x-input-search></x-input-search>--}}
                <h1 class="text-xl text-black">USUARIOS</h1>
                <livewire:user-table />
            </x-card>
        </div>
        <div class="">
            <x-card class="text-white-ghost max-w-7xl mx-auto">
            <h1 class="text-xl text-black">EVENTOS</h1>
                <livewire:event-table />
            </x-card>
        </div>
        <div class="">
            <x-card class="text-white-ghost max-w-7xl mx-auto">
            <h1 class="text-xl text-black">COORGANIZA</h1>
                <livewire:coorganizer-event-table />
            </x-card>
        </div>
        <div class="">
            <x-card class="text-white-ghost max-w-7xl mx-auto">
            <h1 class="text-xl text-black">EVENTOS PROPIOS</h1>
                <livewire:user-events-table />
            </x-card>
        </div>
    </main>

    @stack('modals')

    @livewireScripts

    @if (isset($pageScripts))
    {{ $pageScripts }}
    @endif

</body>

</html>