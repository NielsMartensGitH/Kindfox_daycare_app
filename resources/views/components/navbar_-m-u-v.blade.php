<div id="navbar_MUV">
    <nav class="top-nav navbar navbar-light fixed-top">
        <div class="container-fluid d-flex justify-content-between">
        <a class="navbar-brand">
            <img src="../../assets/img/Kindfoxlogowhite.png" width="100px">
        </a>

        <!-- Settings Dropdown -->
        <div x-data="{ open: false }" class="hidden sm:flex sm:items-center sm:ml-6">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center text-sm font-medium text-white-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <div>{{ Auth::user()->name }}</div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                    <x-dropdown-link  :href="route('chatify')">
                        {{ __('Chatify')}}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
        <div>
            <div class="mx-2">
                @if(!empty(Auth::user()->main_user()->first()->getMedia()[0]))
                    <div class="circular--landscape">
                        <img src="{{Auth::user()->main_user()->first()->getMedia()[0]->getFullUrl()}}">
                    </div>
                @endif
            </div>
        </div>
    </div>
        
            {{-- <div class="nav-links d-flex">         
                <a class="nav-link"><i class="fas fa-bell"></i></a>
                <a class="nav-link" href="#"><i class="fas fa-user"></i></a>
                <a class="nav-link"><i (click)="toggleSideNav()" class="fa-solid fa-bars"></i></a>
            </div> --}}
            
        </div>
    </nav>
</div>