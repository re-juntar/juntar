<x-app-layout>
    {{-- layout contact --}}

    <div class="container max-w-4xl mx-auto border shadow-lg mt-5">
        <x-pink-header>
            Contacto
        </x-pink-header>

        <div class="container max-w-4xl mx-auto text-center ">
            <x-label class="mt-4 ">
                Por cualquier consulta, complete el formulario para contactarnos. Muchas Gracias
            </x-label>
        </div>

        <div class="ml-60">
            <form action="{{ route('mail.store') }}" method="POST">
                @csrf
                <div class="mx-3 ">
                    <x-label class="my-5 ">
                        Nombre:
                    </x-label>
                    <br>
                    <x-input class="w-72" type="text" name='name' value="{{ old('name') }}">
                    </x-input>
                </div>
                <br>
                <div class="mx-3">
                    <x-label class="my-5">
                        Email:
                    </x-label>
                    <br>
                    <x-input class="w-72" type='email' name='email' value="{{ old('email') }}">
                    </x-input>
                </div>
                <div class="mx-3">
                    <x-label class="my-5">
                        Asunto:
                    </x-label>
                    <br>
                    <x-input class="w-72" type='text' name='asunto' value="{{ old('asunto') }}">
                    </x-input>
                </div>
                <br>
                <div class="mx-3 w-96">

                    <x-label>
                        Consulta:
                    </x-label>

                    <textarea id="message" name="detalle" rows="4"
                        class=" block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-50 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Escriba su mensaje aqui"></textarea>

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
