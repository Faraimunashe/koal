<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
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
            //'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'fname' => ['required'],
            'lname' => ['required'],
            'phone' => ['required'],
            'address' => ['required']
        ]);

        $user = User::create([
            'name' => $request->lname.''.substr($request->fname, 0, 1),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->attachRole('user');

        event(new Registered($user));

        $p = new Profile();
        $p->user_id = $user->id;
        $p->fname = $request->fname;
        $p->lname = $request->lname;
        $p->phone = $request->phone;
        $p->address = $request->address;
        $p->save();

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
