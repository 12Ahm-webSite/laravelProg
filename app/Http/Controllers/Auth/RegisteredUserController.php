<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'license' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'birth_date' => ['nullable', 'date'],
            'terms' => ['accepted'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $licensePath = null;
        
        // Handle file upload
        if ($request->hasFile('license')) {
            $licensePath = $request->file('license')->store('licenses', 'public');
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'license' => $licensePath,
            'birth_date' => $request->birth_date,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
        return redirect ('/');
    }
}
