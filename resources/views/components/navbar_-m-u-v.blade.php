<div id="navbar_MUV">
    <nav class="top-nav navbar navbar-light fixed-top">
        <div class="container-fluid d-flex justify-content-between">
        <a class="navbar-brand">
            <img src="../../assets/img/Kindfoxlogowhite.png" width="100px">
        </a>
        <div class="d-flex align-items-center gap-2">
            <div class="dropdown dropdown-notifications">
                <button type="button" class="fas fa-bell position-relative fs-5" id="notification-bell" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="badge bg-danger" style="font-size: 12px">{{ count($notifications) }}</span>
                </button>
                <div class="notification-card dropdown-menu dropdown-menu-start" aria-labelledby="notification-bell">
                    <div class="d-flex justify-content-between align-items-center mx-1 text-sm">
                        <div class="mx-1 p-1">Notifications ({{ count($notifications) }})</div>
                        <a href="{{ route('notifications.read')}}">Mark all as read</a>
                    </div>
                    <div class="notification-cards">
                        @foreach($notifications as $notification)
                        <div class="d-flex p-4 align-items-center justify-content-between border bg-light">
                            <div class="">
                              <i class="fas fa-envelope text-danger mx-2"></i><a class="new-message" href="#">
                                @if ($notification[0]->main_user)
                                {{ $notification[0]->main_user->first_name }}
                                @else
                                {{ $notification[0]->company->name }}
                                @endif
                                added new {{ substr($notification[0]->getTable(), 0, -1) }}</a>
                            </div>
                            <small>{{ $notification[0]->created_at->diffForHumans() }}</small>
                          </div>
                          @endforeach
                    </div>
                </div>
            </div>
            <!-- HIDDEN USER ID -->
            <div class="hidden" id="hidden_user_id">{{ Auth::user()->main_user->id}}</div>
            <!-- Settings Dropdown -->
            <div x-data="{ open: false }" class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-white-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div id="name_navbar" value="{{ Auth::user()->name }}">{{ Auth::user()->name }}</div>
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
                            <x-dropdown-link  :href="route('usersettings')">
                                {{ __('UserSettings')}}
                            </x-dropdown-link>
                            <x-dropdown-link  :href="route('mainuserview')">
                                {{ __('Main Page')}}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                <div>
                    <div class="mx-2">
                        @if(!empty(Auth::user()->main_user()->first()->getMedia()[0]))
                            <div class="circular--landscape" id="profile_img_navbar">
                                <img src="{{Auth::user()->main_user()->first()->getMedia()[0]->getFullUrl()}}">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            </div>
        </div>

    </nav>
</div>
