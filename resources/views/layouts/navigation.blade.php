<nav x-data="{ open: false}" 
class="mx-[20px] max-w-[1500px] bg-[#4B006E] backdrop-blur-[10px] shadow-[0_0_10px_rgba(0,0,0,0.2)] text-white rounded-3xl">
    
    <!-- Primary Navigation Menu -->
    <div class="sm:px-8">
        <div class="flex items-center justify-between h-16">
            <div>
                <!-- Logo -->
                <div class="shrink-0">
                    <a href="{{ route('posts.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-[#FF3F18] text-gray-800 active:translate-y-[2px]" />
                    </a>
                </div>   
            </div>

            @if(request()->routeIs('posts.index'))
                <x-search-form />
                @endif

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48" class="z-[9999]">
                    <x-slot name="trigger">
                        <button class="flex items-center py-2 text-sm text-gray-600 font-medium rounded-md bg-inherit focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <!-- Profile Picture -->
                                @if(Auth::user() && Auth::user()->profile_picture)
                                    <img src="{{ Auth::user()->profile_picture }}" alt="Profile Picture" class="rounded-full border-[2px] border-gray-300 shadow-md w-[35px] h-[35px]">
                                @else
                                    <img src="{{ asset('storage/images/avatar.png') }}" class="rounded-full border-[2px] border-gray-300 shadow-md w-[35px] h-[35px]" alt="">
                                @endif

                                <!-- User Name -->
                                <span class="ms-[5px] font-medium text-white/70">
                                    {{ Auth::user()->name }} 
                                </span>

                            </div>
                            <div class="ms-1">
                                <svg class="fill-white/50 h-4 w-4 active:translate-y-[2px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                   <span class="material-symbols-rounded text-[30px]">menu</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link> --}}
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="flex items-center">
                    <!-- Profile Picture for Responsive View -->
                    {{-- @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture"  class="rounded-full w-2 h-12 mr-2"> --}}

                    {{-- @else
                        <p class="mr-2">No profile picture</p>
                    @endif --}}

                    <div>
                        {{-- <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div> --}}
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>


