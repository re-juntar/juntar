<x-app-layout>
    <x-hero>
        <img class="max-w-full h-auto pl-[10vw] pr-[10vh] mb-4" src="{{asset('images/logos/juntar-logo-w.svg')}}" alt="" />
        <h5 class="text-white uppercase font-medium text-xl mb-4">Sistema de gestión de eventos</h5>
        <x-jet-button class="bg-[#FE1355] uppercase text-lg hover:bg-[#050714]">Empezar</x-jet-button>
    </x-hero>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
