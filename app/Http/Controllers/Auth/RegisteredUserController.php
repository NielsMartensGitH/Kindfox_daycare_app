<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MainUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUp;
use Faker\Factory;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.registerUser');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $faker = Factory::create('nl_BE');

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'streetnr' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:4'],
            'city' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_pic' => ['nullable'],
            'role_id' => 'required'
        ]);

        $main_user = MainUser::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'street_number' => $request->input('streetnr'),
            'country' => $request->input('country'),
            'postal_code' => $request->input('postal_code'),
            'city' => $request->input('city'),
            'phone_number' => $request->input('phone'),
            'main_user_code' => $faker->bothify('?????-#####-?????')
        ]);


        $user = User::create([
            'name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'main_user_id' => $main_user->id
        ]);

        if ($request->user_pic) {
            $main_user->addMedia($request->file('user_pic')->path())->toMediaCollection();
        }
        else {
            $main_user->addMediaFromUrl('https://nielsmartens-cv.netlify.app/person-icon.png')->toMediaCollection();
        }

        event(new Registered($user));

        Auth::login($user);

        Mail::to('fake@mail.com')->send(new SignUp($main_user->first_name, $main_user->main_user_code));

        return redirect(RouteServiceProvider::HOME);
    }
}
