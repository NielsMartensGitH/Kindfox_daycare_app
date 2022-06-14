<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register_user') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex gap-5">
            <div class="w-50">
                <div>
                    <x-label for="first_name" :value="__('First Name')" />
                    <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="last_name" :value="__('Last Name')" />
                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="streetnr" :value="__('Street/number')" />
                    <x-input id="streetnr" class="block mt-1 w-full" type="text" name="streetnr" :value="old('streetnr')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="country" :value="__('Country')" />
                    <x-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="postal_code" :value="__('Postal Code')" />
                    <x-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="city" :value="__('City')" />
                    <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="phone" :value="__('Phone number')" />
                    <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus />
                </div>
            </div>
            <div class="w-50">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>
            <div class="mt-4">
                <x-label for="email" :value="__('Profile picture')" />

                <input type="file" class="form-control" name="user_pic" id="user_pic" accept="image/png, image/gif, image/jpeg">
            </div>
            <div class="flex justify-around gap-1 flex-wrap" id="prevImages"></div> {{-- for showing preview of images --}}
            <input type="hidden" name="role_id" value=1>

            </div>
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
