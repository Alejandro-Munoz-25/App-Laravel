<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-50 transition duration-700 sticky z-40 inset-x-0 top-0">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex gap-x-2 items-center">
                    <a href="{{ route('home') }}" class="text-black dark:text-white">
                        {{__('Laragram')}}
                    </a>
                    <button id="switchTheme" class=" text-yellow-500 focus:outline-none relative">
                        <svg class="w-6 h-6 hover:text-black focus:text-gray-500 dark:hover:text-purple-50 dark:focus:text-purple-50" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fillRule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clipRule="evenodd" />
                        </svg>
                    </button>
                </div>

                @auth
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex justify-self-center">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('likes.index')" :active="request()->routeIs('likes.index')">
                        {{ __('Favorites ') }}
                    </x-nav-link>
                    <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                        {{ __('Profiles') }}
                    </x-nav-link>
                    <x-nav-link :href="route('image.create')" :active="request()->routeIs('image.create')">
                        {{ __('Upload Image') }}
                    </x-nav-link>
                </div>
                @endauth
            </div>

            <!-- Settings Dropdown -->
            @if (Route::has('login'))
            @auth
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <x-dropdown align="right" width="40">
                    <x-slot name="trigger">
                        <x-avatar class="rounded-full h-10 w-10 mr-2 cursor-pointer" />
                        <button class="flex items-center ml-2 dark:hover:text-gray-100 dark:text-gray-300 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>
                                {{ Auth::user()->name }}
                            </div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('user.profile',['id'=>Auth::user()->id])">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('config')">
                            {{ __('Settings') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" class="mb-0">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth
            @endif

            @auth
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 focus:text-gray-500 dark:focus:text-gray-300 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            @endauth
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            @auth
            <x-responsive-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                {{ __('Profiles') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('image.create')" :active="request()->routeIs('image.create')">
                {{ __('Upload Image') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('likes.index')" :active="request()->routeIs('likes.index')">
                {{ __('Favorites') }}
            </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <x-avatar class="rounded-full h-16 w-16" />
                </div>

                <div class="ml-3">
                    @if (Route::has('login'))
                    @auth
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200 transition-colors duration-700">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500 dark:text-gray-200 transition-colors duration-700">{{ Auth::user()->email }}</div>
                    @endauth
                    @endif
                </div>
            </div>

            <div class="mt-3 space-y-1">
                @auth
                <!-- Links -->
                <x-responsive-nav-link :href="route('user.profile',['id'=>Auth::user()->id])">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('config')">
                    {{ __('Settings') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log out') }}
                    </x-responsive-nav-link>
                </form>
                @else
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>
