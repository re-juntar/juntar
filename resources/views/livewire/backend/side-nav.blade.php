<div x-cloak x-data="{ ham: true }" class="relative flex">
    <div class="fixed top-4 left-48 z-40 transition-all duration-300"
        :class="{ 'left-48': ham, 'left-0': !ham }">
        <div class="flex justify-end">
            <button @click="ham = !ham"
                :class="{ 'hover:bg-awesome': !ham, 'hover:bg-awesome': ham }"
                class="transition-all duration-300 w-8 p-1 mx-3 my-2 rounded-full focus:outline-none"
                wire:click="$emitUp('toggleBar')">
                <i class="fa fa-bars text-awesome text-xl"
                    :class="{ 'text-gray-600': !ham, 'text-gray-300': ham }"></i>
            </button>
        </div>
    </div>
    <div x-cloak wire:ignore :class="{ 'w-60': ham, 'w-0': !ham }"
        class="fixed top-0 bottom-0 left-0 z-30 block w-60 h-full min-h-screen overflow-y-auto transition-all duration-300 ease-in-out bg-fogra-dark shadow-lg overflow-x-hidden">
        <div class="mr-8 pt-4 pb-2 px-6">
            <a href="{{ route('back-home')}}">
                <div class="flex items-center">
                    <img src="{{ asset('images/logos/juntar-logo-w.svg') }}" alt="">
                </div>
            </a>
        </div>
        <nav>
            <ul class="relative px-1 mt-2" :class="{ 'opacity-1': ham, 'opacity-0': !ham }">
                <li class="relative">
                    <form>
                        <div class="flex items-center justify-center py-4 h-12">
                            <input class="text-base text-gray-400 flex-grow outline-none px-2 rounded-lg" type="text"
                                placeholder="Buscar" />
                            <div class="absolute top-3 right-2">
                                <button type="submit" class="text-black">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </li>
                <li class="relative">
                    <x-backend.side-nav-link href="{{ route('back-home') }}" :active="request()->routeIs('back-home')">
                        {{ __('Inicio') }}
                    </x-backend.side-nav-link>
                </li>
                <li class="relative">
                    <x-backend.side-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')">
                        {{ __('Usuarios ') }}
                    </x-backend.side-nav-link>
                </li>
                <li class="relative">
                    <x-backend.side-nav-link href="{{ route('events') }}" :active="request()->routeIs('events')">
                        {{ __('Eventos ') }}
                    </x-backend.side-nav-link>
                </li>
                <li class="relative">
                    <x-backend.side-nav-link href="{{ route('endorsements') }}" :active="request()->routeIs('endorsements')">
                        {{ __('Avales ') }}
                    </x-backend.side-nav-link>
                </li>
                <li class="relative">
                    <x-backend.side-nav-link href="{{ route('eventModalities') }}" :active="request()->routeIs('eventModalities')">
                        {{ __('Modalidades') }}
                </li>
                <li class="relative">
                    <x-backend.side-nav-link href="{{ route('roles') }}" :active="request()->routeIs('roles')">
                        {{ __('Roles') }}
                    </x-backend.side-nav-link>
                </li>
                {{-- <li class="relative">
                    <x-backend.dropdown>
                        <x-slot name="dropName">
                            {{ __('Dropdown') }}
                        </x-slot>
                        <x-slot name="links">
                            <x-backend.side-nav-link>
                                {{ __('Link ') }}
                            </x-backend.side-nav-link>
                        </x-slot>
                    </x-backend.dropdown>
                </li> --}}

            </ul>
            <div class="bg-fogra-dark text-center bottom-0 absolute w-full">
                <hr class="border-awesome m-0">
                <x-backend.dropdown>
                    <x-slot name="profile">
                        <img class="h-8 w-8 rounded-full object-cover mr-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        <div class="font-bold text-xs uppercase text-white-ghost mr-1">
                            {{ Auth::user()->name }}
                        </div>
                    </x-slot>
                    <x-slot name="links">
                        <x-backend.side-nav-link class="text-md" href="{{ route('profile.show') }}" {{-- :active="request()->routeIs('')" --}}>
                            {{ __('Perfil') }}
                        </x-backend.side-nav-link>
                        <x-backend.side-nav-link class="text-md" href="{{ route('home') }}">
                            {{ __('Juntar') }}
                        </x-backend.side-nav-link>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-backend.side-nav-link class="text-md" href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Cerrar Sesión') }}
                            </x-backend.side-nav-link>
                        </form>
                    </x-slot>
                </x-backend.dropdown>
                <hr class="border-awesome m-0">
                <p class="py-2 text-md text-white-ghost ">© Juntar 2022</p>
            </div>
        </nav>
    </div>
</div>