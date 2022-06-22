<nav x-data="{ open: false }" class="bg-fogra-dark w-60 h-full shadow-md bg-white absolute">

    <div class="pt-4 pb-2 px-6">
      <a href="#">
        <div class="flex items-center">
          <img src="{{asset('images/logos/juntar-logo-w.svg')}}" alt="">
        </div>
      </a>
    </div>

    <ul class="relative px-1 mt-2">

      <li class="relative">
        <x-backend.side-nav-link href="{{ route('gestionar') }}" :active="request()->routeIs('gestionar')">
          {{ __('Inicio') }}
        </x-backend.side-nav-link>
      </li>

      <li class="relative">
        <x-backend.side-nav-link {{-- href="{{ route('') }}" :active="request()->routeIs('')" --}}>
          {{ __('Link ') }}
        </x-backend.side-nav-link>
      </li>

      <li class="relative">
        <x-backend.side-nav-link {{-- href="{{ route('') }}" :active="request()->routeIs('')" --}}>
          {{ __('Link ') }}
        </x-backend.side-nav-link>
      </li>

      <li class="relative">
        <x-backend.side-nav-link href="" {{-- href="{{ route('') }}" :active="request()->routeIs('')" --}}>
          {{ __('Link ') }}
        </x-backend.side-nav-link>
      </li>

      <li class="relative">
        <x-backend.side-nav-link {{-- href="{{ route('') }}" :active="request()->routeIs('')" --}}>
          {{ __('Link ') }}
        </x-backend.side-nav-link>
      </li>

      <li class="relative">
        <x-backend.side-nav-link {{-- href="{{ route('') }}" :active="request()->routeIs('')" --}}>
          {{ __('Link ') }}
        </x-backend.side-nav-link>
      </li>

      <li class="relative">
        <x-backend.side-nav-link {{-- href="{{ route('') }}" :active="request()->routeIs('')" --}}>
          {{ __('Link ') }}
        </x-backend.side-nav-link>
      </li>

    </ul>

    <div class="text-white-ghost bg-fogra-dark text-center bottom-0 absolute w-full">
      <hr class="border-awesome m-0">
      <p class="py-2 text-md">© Juntar 2022</p>
    </div>
  </nav>