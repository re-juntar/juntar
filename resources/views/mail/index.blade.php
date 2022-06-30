<x-app-layout>

    {{-- layout contact --}}
    <div class="container mx-auto max-w-4xl  border shadow-lg mt-5 ">
        <x-pink-header>
            Contacto
        </x-pink-header>

        <div class="container max-w-4xl mx-auto text-center  ">
            <x-label class="mt-4 ">
                Por cualquier consulta, complete el formulario para contactarnos. Muchas Gracias
            </x-label>
        </div>

        <div class="mx-auto max-w-md  ">
            <form action="{{ route('mail.store') }}" method="POST">

                @csrf
                <div class="mx-3 ">
                    <x-label class="my-5">
                        Nombre:
                    </x-label>
                    <br>
                    <x-input
                        class="w-full sm:w-50 transition ease-in-out 50  hover:-translate-y-1 hover:scale-10  duration-300 "
                        type="text" id="name" name='name' value="{{ old('name') }}">
                    </x-input>
                    @error('name')
                        <div class="error-message text-red-600">* {{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="mx-3">
                    <x-label class="my-5">
                        Email:
                    </x-label>
                    <br>
                    <x-input
                        class=" w-full transition ease-in-out delay-50  hover:-translate-y-1 hover:scale-10  duration-300"
                        type='email' id="email" name='email' value="{{ old('email') }}">
                    </x-input>
                    @error('email')
                        <p class="error-message text-red-600">* {{ $message }}</p>
                    @enderror
                </div>
                <div class="mx-3">
                    <x-label class="my-5">
                        Asunto:
                    </x-label>
                    <br>
                    <x-input
                        class="w-full transition ease-in-out delay-50  hover:-translate-y-1 hover:scale-10  duration-300"
                        type='text' id="subject" name='subject' value="{{ old('subject') }}">
                    </x-input>
                    @error('subject')
                        <p class="error-message text-red-600">* {{ $message }}</p>
                    @enderror
                </div>
                <br>
                <div class="mx-3 ">

                    <x-label>
                        Consulta:
                    </x-label>

                    <textarea id="query" name="query" rows="4"
                        class=" block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border  focus:ring-blue-500 focus:border-blue-500   dark:text-black  dark:focus:border-blue-500  transition ease-in-out delay-50  hover:-translate-y-1 hover:scale-10  duration-300"
                        placeholder="Escriba su mensaje aqui"> {{ old('detalle') }}
                    </textarea>
                    @error('query')
                        <p class="error-message text-red-500 ">* {{ $message }} </p>
                    @enderror
                </div>
                <div class="my-5 ml-3">

                    <x-button type='submit'>
                        Enviar
                    </x-button>
                </div>
            </form>
        </div>
    </div>

    <x-jet-section-border />
</x-app-layout>
