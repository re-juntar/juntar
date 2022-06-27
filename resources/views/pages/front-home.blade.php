<div>
    <x-hero>
        <img class="max-w-full h-auto mb-4" src="{{ asset('images/logos/juntar-logo-w.svg') }}" alt="" />
        <h5 class="text-white-ghost uppercase font-medium text-xl mb-4">Sistema de gestión de eventos</h5>
    </x-hero>

    <section class="bg-fogra-darkish w-full">
        @livewire('search-sort-form')
    </section>

    <section class="pt-16 pb-5 px-4 bg-fogra-dark">
        <div class="mx-auto infinite-scr">
            @foreach ($events as $event)
                <x-card id="{{ $event->id }}" class="grid-item mb-4 md:mx-2 w-[300px]">
                    {{-- @php
                    $src = $event['image_flyer'];
                    if ($event['image_flyer'] == null) {
                        $src = 'images/public/event-card-placeholder.png';
                    }
                    @endphp
                    <a href="#modal" wire:click="showModal({{ $event }})">
                        <img class="rounded-lg" src="{{ asset($src) }}" alt="">
                        <x-verified-badge class="absolute top-4 right-4 z-10" />
                    </a> --}}

                    @livewire('event-card-responsive', ['event' => $event])

                    <div class="flex items-center bg-fogra-darkish rounded-lg mt-1">
                        <img class="w-10 h-10 rounded-full mr-2" src="{{ asset('images/logos/logo-uncoma-w.svg') }}">
                        <div class="font-bold text-xl uppercase text-white-ghost py-4">
                            Nombre Apellido
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>
        <div class="text-center">
            <x-button class="more">
                {{ __('Cargar más...') }}
            </x-button>
        </div>
    </section>

    @livewire('event-modal')

    <x-slot name="pageScripts">
        <script src="{{ asset('vendor/masonry.pkgd.js') }}"></script>
        <script src="{{ asset('vendor/infinite-scroll.pkgd.js') }}"></script>
        <script>
            var msnry = new Masonry('.infinite-scr', {
                itemSelector: ".grid-item",
                horizontalOrder: true,
                fitWidth: true
            });
            let infScroll = new InfiniteScroll('.infinite-scr', {
                path: "http://juntar.test/home?page=@{{#}}",
                append: '.grid-item',
                history: false,
                scrollThreshold: false,
                button: ".more",
                outlayer: msnry
            });
            infScroll.on('append', function(){ window.Livewire.rescan(); });
        </script>
    </x-slot>


</div>