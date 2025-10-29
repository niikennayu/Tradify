<nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- Logo --}}
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}">
                       <img src="{{ asset('storage/images/Tradify.png') }}" 
                             alt="Tradify Logo" 
                             class="h-10 w-auto">
                    </a>
                </div>

                {{-- Menu Admin --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('admin.units.index')" :active="request()->routeIs('admin.units.*')">
                        {{ __('Kelola Produk') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                        {{ __('Kelola Kategori') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                        {{ __('Kelola User') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.rentals.index')" :active="request()->routeIs('admin.rentals.*')">
                        {{ __('Riwayat Booking') }}
                    </x-nav-link>
                </div>
            </div>

            {{-- Dropdown Admin --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white hover:text-gray-800 rounded-md">
                            <div>{{ Auth::user()->name }} <span class="text-xs text-red-500">(Admin)</span></div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('admin.dashboard')">
                            {{ __('Dashboard Admin') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
