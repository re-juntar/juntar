<x-app-layout>
    <x-hero>
        <img class="max-w-full h-auto mb-4" src="{{asset('images/logos/juntar-logo-w.svg')}}" alt="" />
        <h5 class="text-white uppercase font-medium text-xl mb-4">Sistema de gestión de eventos</h5>
        <x-jet-button class="bg-[#FE1355] uppercase text-lg hover:bg-[#050714]">Empezar</x-jet-button>
    </x-hero>

    <section class="bg-[#0B0D19] w-full">
        @livewire('search-sort-form')
    </section>

    <section class="pt-16 pb-5 px-4 bg-[#050714]">
        <x-grid>
            @foreach($arr as $sub)
            <div class="break-inside-avoid mb-2 rounded-lg">
                @foreach($sub as $event)
                    <div id="{{$event->id}}" class="w-full">
                        <div class="w-full p-2">
                            <x-card class="w-full h-full">
                                <div class="relative">
                                    <img class="rounded-lg" src="{{asset($event['image_flyer'])}}" alt="">
                                </div>
                            </x-card>
                        </div>
                    </div>
                @endforeach
            </div>
            @endforeach
        </x-grid>
    </section>

    {{-- <section class="pt-16 pb-5 px-4 bg-[#050714]">
        <div class="w-full px-4 mx-auto py-[3vh]">
            <div class="flex flex-wrap -mx-4">
                <div class="px-20 w-full flex flex-wrap">
                    @foreach($arr as $sub)
                    <div id="{{$loop->index}}" class="w-1/5">
                        @foreach($sub as $event)
                        <div id="{{$loop->index}}" class="w-full">
                            <div class="w-full p-2">
                                <x-card class="w-full h-full">
                                    <div class="relative">
                                        <img class="rounded-lg" src="{{asset($event['image_flyer'])}}" alt="">
                                    </div>
                                </x-card>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </section> --}}
    
</x-app-layout>