<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Rules\MatchOldPassword;
use Exception;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function change(Request $request)
    {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);


        if($request->old_password == $request->password){
            return redirect()->back()->with('error', 'Please change from old password');
        }

        try{
            User::find(Auth::id())->update(['password'=> Hash::make($request->password), 'remember_token'=>null]);
            return redirect()->back()->with('success', 'Successfully Changed Password');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
