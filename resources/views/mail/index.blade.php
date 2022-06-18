<x-app-layout>
    {{-- layout contact --}}
    <div class="max-w-lg mx-auto bg-white-ghost border shadow-lg rounded-[0.25rem] py-[3vh] mb-4">
        <x-pink-header class="w-full">
            Contacto
        </x-pink-header>

        <x-label class="mt-4 text-center">
            Por cualquier consulta, complete el formulario para contactarnos. Muchas Gracias
        </x-label>
        <div class="px-[4vh]">
            <form action="{{ route('mail.store') }}" method="POST">
                @csrf

                <div>
                    <x-label for="name">Nombre</x-label>
                    <x-input id="name" class="w-full" type="text" name="name" :value="old('name')"/>
                    @error('name')
                        <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-label for="email">Email</x-label>
                    <x-input id="email" class="w-full" type="text" name="email" value="{{old('email')}}"/>
                    @error('email')
                        <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-label for="subject">Asunto</x-label>
                    <x-input id="subject" class="w-full" type="text" name="subject" value="{{old('subject')}}"/>
                    @error('subject')
                        <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-label for="query">Consulta</x-label>
                    <textarea id="query" class="block" name="query" rows="5" cols="30">
                    {{old('query')}}
                    </textarea>
                    @error('query')
                        <div class="flex items-center">
                            <p class="text-red-600">{{$message}}</p>
                        </div>
                    @enderror
                </div>

                <x-button type='submit'>
                    Enviar
                </x-button>

            </form>
        </div>
    </div>

</x-app-layout>
