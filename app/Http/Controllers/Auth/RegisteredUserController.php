<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'documentType' => 'required|in:CC,CE,TI,NIT,RUT',
            'document' => 'required|integer|min:5',
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'surname' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'mobile' => 'required|integer',
            'address' => 'required|max:30|regex:/^[a-zA-Z0-9\s\-#]+$/',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'documentType' => $request->documentType,
            'document'=> $request->document,
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
