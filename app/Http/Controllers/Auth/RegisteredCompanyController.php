<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredCompanyController extends Controller
{
        /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.registerCompany');
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
        $request->validate([
            'streetnr' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:4'],
            'city' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'vat' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company_pic' => ['nullable'],
            'role_id' => 'required'
        ]);

        $company = Company::create([
            'name' => $request->input('company_name'),
            'vat_number' => $request->input('vat'),
            'street_number' => $request->input('streetnr'),
            'country' => $request->input('country'),
            'postal_code' => $request->input('postal_code'),
            'city' => $request->input('city'),
            'phone_number' => $request->input('phone'),
        ]);

        $company->addMedia($request->file('company_pic')->path())->toMediaCollection();

        $user = User::create([
            'name' => $request->company_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'company_id' => $company->id
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::DASHBOARD);
    }
}
