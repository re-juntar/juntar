<div>
    <x-hero>
        <img class="max-w-full h-auto mb-4" src="{{ asset('images/logos/juntar-logo-w.svg') }}" alt="" />
        <h5 class="text-white-ghost uppercase font-medium text-xl mb-4">Sistema de gestión de eventos</h5>
    </x-hero>

    <section class="bg-fogra-darkish w-full">
        @livewire('search-sort-form')
    </section>
    @if(session('message'))
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex justify-center">
          <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
          <div>
            <p class="font-bold">{{session('message')}}</p>

          </div>
        </div>
      </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex justify-center  " role="alert">
        <strong class="font-bold">Error! &nbsp; </strong>
        <span class="block sm:inline"> {{session('error')}}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span> 
    </div>
    @endif
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

                    {{-- <div class="flex items-center bg-fogra-darkish rounded-lg mt-1">
                        <img class="w-10 h-10 rounded-full mr-2" src="{{ $event->user->profile_photo_url }}">
                        <div class="font-bold text-xl uppercase text-white-ghost py-4">
                            {{$event->user->name}} {{$event->user->surname}}
                        </div>
                    </div> --}}
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