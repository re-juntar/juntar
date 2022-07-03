<form method="POST" action="{{route('home')}}">
    @csrf
    <div class="container flex flex-col sm:flex-row mx-auto p-14 max-w-4xl">
        <div class="flex flex-row items-center px-2 py-1 justify-between w-full sm:m-0">
            <input class="text-base text-gray-400 flex-grow outline-none px-2 rounded-l-lg" name="search" id="search" type="text" placeholder="Buscar" />
            <button type="submit" class="bg-awesome text-white-ghost text-base rounded-r-lg border border-awesome px-4 py-2 font-thin hover:bg-fogra-dark">Buscar</button>
        </div>
        <!-- <div class="flex items-center px-2 rounded-lg">
            <select id="" class="text-base text-gray-800 outline-none min-w-full border-2 px-4 py-2 rounded-lg">
                <option value="" disabled selected>Ordenar por...</option>
                <option value="">Fecha de inicio</option>
                <option value="">Fecha de creación</option>
            </select>
        </div> -->
    </div>
</form>