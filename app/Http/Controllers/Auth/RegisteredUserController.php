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
        return view('dashboardADIMN.addUsernew');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phoneNUM' => 'required|string',
            'userDP' => 'required',
            'image',
            'usertype' => 'string',
            'gender' => 'string',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $dpName = time() . "." . $request->userDP->extension();
        $request->userDP->move(public_path('zdpuser'), $dpName);
        $user = User::create([
            'name' => $request->name,
            'phoneNUM' => $request->phoneNUM,
            'userDP' => $dpName,
            'usertype' => $request->usertype,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
        if ($request->user()->usertype === 'admin') {
            return redirect('/dashboard');

        }
        if ($request->user()->usertype === 'user') {
            return redirect('/userDash');
        }
        if ($request->user()->usertype === 'itEng') {
            return redirect('/engDash');
        }

        return redirect(route('userDash', absolute: false));

    }
}
