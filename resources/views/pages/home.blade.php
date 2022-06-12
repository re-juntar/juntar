<x-app-layout>
    <x-hero>
        <img class="max-w-full h-auto mb-4" src="{{ asset('images/logos/juntar-logo-w.svg') }}" alt="" />
        <h5 class="text-white-ghost uppercase font-medium text-xl mb-4">Sistema de gestión de eventos</h5>
        <x-jet-button class="bg-awesome uppercase text-lg text-white-ghost hover:bg-fogra-dark">Empezar</x-jet-button>
    </x-hero>

    <section class="bg-fogra-darkish w-full">
        @livewire('search-sort-form')
    </section>

    <section class="pt-16 pb-5 px-4 bg-fogra-dark">
        <x-grid>
            @foreach ($arr as $sub)
                <div class="break-inside-avoid mb-2 rounded-lg">
                    @foreach ($sub as $event)
                        <div id="{{ $event->id }}" class="w-full">
                            <div class="w-full p-2">
                                <x-card class="w-full h-full">
                                    <div class="relative">
                                        <img class="rounded-lg" src="{{ asset($event['image_flyer']) }}" alt="">
                                    </div>
                                </x-card>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </x-grid>
    </section>
</x-app-layout>
