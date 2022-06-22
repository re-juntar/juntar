@props(['parent'])

<div class="relative" id="sidenavSecEx3">
  <a class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out cursor-pointer" data-mdb-ripple="true" data-mdb-ripple-color="primary" data-bs-toggle="collapse" data-bs-target="#collapseSidenavSecEx3" aria-expanded="false" aria-controls="collapseSidenavSecEx3">
    <span>Collapsible item 2</span>
  </a>
  <ul class="relative accordion-collapse collapse" id="collapseSidenavSecEx3" aria-labelledby="sidenavSecEx3" data-bs-parent="#{{$parent}}">
    <li class="relative">
      <x-backend.dropdown-link></x-backend.dropdown-link>
    </li>
    <li class="relative">
      <x-backend.dropdown-link></x-backend.dropdown-link>
    </li>
  </ul>
</div>