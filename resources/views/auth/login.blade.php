
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

<div class="container">
    <div class="kindfoxlogo">
    <img src="../../assets/img/Kindfoxlogowhite.png" alt="logokindfox" width="320px" class="frontlogo">
    </div>
    <div class="row">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <div class="headofcanvas">
                    <img src="../../assets/img/Kindfoxlogowhite.png" width="150px" class="logo">
                    <h5 class="offcanvas-title" id="offcanvasLabel">Parent Login</h5>
                </div>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form >
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="Pemail" [(ngModel)]="email" name="email">
                    <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="PPassword" [(ngModel)]="password" name="password">
                        <br>
                        <button type="submit" class="btn btn-kindfox-primary" (click)="Plogin()">Login</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <img src="../../assets/img/Kindfoxlogowhite.png" width="150px" class="logo">
                <h5 id="offcanvasRightLabel">Daycare Login</h5>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">                
                <form >
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="DCEmail" [(ngModel)]="email" name="email">
                    <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="DCPassword" [(ngModel)]="password" name="password">
                        <br>
                        <button type="submit" class="btn btn-kindfox-primary my-2" (click)="DClogin()">Login</button>
                        <br>
                        <button type="button" class="btn btn-kindfox-primary" routerLink="../register">Register</button>
                        No account? Register here!
                    </div>
                </form>
            </div>
          </div>

        <div class="col family" id="fam" Data-bs-toggle="offcanvas" href="#offcanvasExample">
            <p class="noselect">Parents</p>
        </div>
        <div class="col daycare" id="dc" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
            <p class="noselect">Daycares</p>
        </div>
    </div>
</div>