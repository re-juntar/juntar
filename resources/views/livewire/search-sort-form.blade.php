<form clas method="POST" action="{{route('home')}}">
    @csrf
    <div class="container flex sm:flex-row mx-auto py-6 w-full">
        <div class="flex flex-row  w-full sm:m-0 ">
            <input class="text-base text-gray-400 flex-grow outline-none  rounded-l-lg" name="search" id="search" type="text" placeholder="Buscar" />
            <button type="submit" class="bg-awesome text-white-ghost text-base rounded-r-lg border border-awesome px-4 py-2 font-thin hover:bg-fogra-dark">Buscar</button>
        </div>
    </div>
</form>
