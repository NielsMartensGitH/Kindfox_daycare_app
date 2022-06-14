
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <!-- DASHBOARD MENU -->
                <div class="sb-sidenav-menu-heading">Menu</div>

                <a class="nav-link" href="{{ route('dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-baby"></i></div>
                    <span class="mx-2">Children</span>
                </a>
                <a class="nav-link" href="{{ route('parents')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    <span class="mx-1">Parents</span>
                </a>
                <a class="nav-link" href="{{ route('posts')}}">
                    <div class="sb-nav-link-icon"><i class="far fa-envelope"></i></div>
                    <span class="mx-2">Posts</span>
                </a>

                <a class="nav-link" href="{{ route('diaries')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                    <span class="mx-2">Diaries</span>
                </a>

            </div>
        </div>
        <!-- HERE WE SEE WHICH DAYCARE WE ARE LOGGED IN AS -->
        <div class="sb-sidenav-footer">
            <div class="d-flex justify-content-left flex-gap-2 align-items-center">

               <!--<div> -->
                    <!--<img src="{{--Auth::user()->company()->first()->getMedia()[0]->getFullUrl()--}}" width="35px" class="mx-2 rounded-circle">-->
               <!-- </div>-->

               <div class="mx-2">
                    <div class="circular--landscape">
                        <img id="profile_img_sidebar" src="{{Auth::user()->company()->first()->getMedia()[0]->getFullUrl()}}">
                    </div>
                </div>

                <div>
                    <h4>{{ Auth::user()->name }}</h4>
                </div>
                </div>
        </div>
    </nav>
</div>