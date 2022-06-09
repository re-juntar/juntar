<x-app-layout>
    <x-hero>
        <img class="max-w-full h-auto mb-4" src="{{asset('images/logos/juntar-logo-w.svg')}}" alt="" />
        <h5 class="text-white uppercase font-medium text-xl mb-4">Sistema de gestión de eventos</h5>
        <x-jet-button class="bg-[#FE1355] uppercase text-lg hover:bg-[#050714]">Empezar</x-jet-button>
    </x-hero>

    <section class="pt-16 pb-5 px-4 bg-[#0B0D19]">
        <div class="w-full px-1 py-[1vh] mx-auto">
            <form action="">
                
            </form>
        </div>
    </section>
        
    <section class="pt-16 pb-5 px-4 bg-[#050714]">
        <div class="w-full px-4 mx-auto py-[3vh]">
            <div class="flex flex-wrap -mx-4">
                {{-- Aca empezaría el foreach de eventos --}}
                <div class="relative w-full px-4 basis-2/6 max-w-[33%] mb-12">
                    <x-card>
                        <h1>Holi</div>
                    </x-card>
                </div>
                
            </div>
        </div>
    </section>

</x-app-layout>
