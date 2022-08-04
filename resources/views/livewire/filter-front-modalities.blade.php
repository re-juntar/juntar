<form class="" method="POST" action="{{ route('home') }}">
    @csrf
    <div class="flex justify-center lg:justify-end">

        <button id="dropdownDefault" data-dropdown-toggle="dropdown"
            class="text-gray-200 m-2  bg-gray-800 rounded-lg px-4 py-3 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button"><i class="fa-solid fa-filter mr-3"></i>Filtros 
            </svg></button>

    </div>
    <!-- Dropdown menu -->
    <div class="flex justify-center lg:justify-end ">
        <div id="dropdown"
            class="hidden justify-center items-center w-33 bg-gray-800 rounded  divide-gray-100 shadow dark:bg-gray-700 "
            data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                @isset($modalities)
                    @foreach ($modalities as $modality)
                        <li>
                            <button id="filter{{ $modality->id }}" name="filter{{ $modality->id }}" type="submit"
                                class="block py-2 text-white-ghost">{{ $modality->description }}</button>
                        </li>
                    @endforeach
                @endisset

            </ul>
        </div>
    </div>



</form>
<script>
    $("#dropdownDefault").click(function(e) {
        $("#dropdown").toggle("300");
    });
</script>
