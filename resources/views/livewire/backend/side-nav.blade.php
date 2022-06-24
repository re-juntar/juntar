<div x-cloak x-data="sidebar()" class="relative flex">
    <div class="fixed top-4 left-48 z-40 transition-all duration-300"
        :class="{ 'left-48': sidebarOpen, 'left-0': !sidebarOpen }">
        <div class="flex justify-end">
            <button @click="sidebarOpen = !sidebarOpen"
                :class="{ 'hover:bg-awesome': !sidebarOpen, 'hover:bg-awesome': sidebarOpen }"
                class="transition-all duration-300 w-8 p-1 mx-3 my-2 rounded-full focus:outline-none">
                <i class="fa fa-bars text-awesome text-xl"
                    :class="{ 'text-gray-600': !sidebarOpen, 'text-gray-300': sidebarOpen }"></i>
            </button>
        </div>
    </div>
    <div x-cloak wire:ignore :class="{ 'w-60': sidebarOpen, 'w-0': !sidebarOpen }"
        class="fixed top-0 bottom-0 left-0 z-30 block w-60 h-full min-h-screen overflow-y-auto transition-all duration-300 ease-in-out bg-fogra-dark shadow-lg overflow-x-hidden">
        <div class="mr-8 pt-4 pb-2 px-6">
            <a href="#">
                <div class="flex items-center">
                    <img src="{{ asset('images/logos/juntar-logo-w.svg') }}" alt="">
                </div>
            </a>
        </div>
        <nav>
            <ul class="relative px-1 mt-2" :class="{ 'opacity-1': sidebarOpen, 'opacity-0': !sidebarOpen }">
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
            <div class="bg-fogra-dark text-center bottom-0 absolute w-full">
                <hr class="border-awesome m-0">
                <x-backend.dropdown :active="request()->routeIs('gestionar')">
                    <x-slot name="profile">
                        <img class="h-8 w-8 rounded-full object-cover mr-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        <div class="font-bold text-xs uppercase text-white-ghost">
                            {{ Auth::user()->name }}
                        </div>
                    </x-slot>
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
                </x-backend.dropdown>
                <p class="py-2 text-md text-white-ghost ">© Juntar 2022</p>
            </div>
        </nav>
    </div>
    <script>
        function sidebar() {
            return {
                sidebarOpen: true,
                openSidebar() {
                    this.sidebarOpen = true
                },
                closeSidebar() {
                    this.sidebarOpen = false
                },
            }
        }
    </script>
</div>