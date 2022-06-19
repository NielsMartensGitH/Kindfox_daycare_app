@props(['notifications'])
<nav class="sb-topnav navbar navbar-expand navbar-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">
        <img src="{{ asset('assets/img/Kindfoxlogowhite.png') }}" width="125px">
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <div class="nav-link">
                <div class="dropdown dropdown-notifications">
                    <button type="button" class="fas fa-bell position-relative fs-6" id="notification-bell" data-bs-toggle="dropdown" aria-expanded="false">
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
                                    <div class="">
                                        <i class="fas fa-envelope text-danger mx-2"></i><a class="new-message" href="#">
                                          @if ($notification[0]->main_user)
                                          {{ $notification[0]->main_user->first_name }}
                                          @else
                                          {{ $notification[0]->company->name }}
                                          @endif
                                          added new {{ substr($notification[0]->getTable(), 0, -1) }}</a>
                                      </div>
                                </div>
                                <small>{{ $notification[0]->created_at->diffForHumans() }}</small>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="hidden" id="hidden_company_id">{{ Auth::user()->company->id}}</div>
            </div>
        </li>
    </ul>
</nav>