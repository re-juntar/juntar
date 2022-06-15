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
        <div class="mx-auto" data-masonry='{ "itemSelector": ".grid-item", "horizontalOrder": true, "fitWidth": true}'>
            @foreach ($events as $event)
                <x-card id="{{ $event->id }}" class="grid-item w-full mb-4 md:mx-2 md:w-[300px]">
                    @php
                        $src = $event['image_flyer'];
                        if($event['image_flyer'] == null){
                            $src = 'images/public/event-card-placeholder.png';
                        }
                    @endphp
                    <img class="rounded-lg" src="{{ asset($src) }}" alt="">
                </x-card>
            @endforeach
        </div>
    </section>
</x-app-layout>
