<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check email
        $user = User::where('name', $fields['name'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return back()->with('error', 'Bad credentials');
        }

        if (Auth::guard('user')->attempt(['name' => request('name'),
            'password' => request('password')])) {
            //dd('hi');
            return redirect()->route('/user/index')
                ->with('success', 'Logged In Successfully');

        } else {
            return back()->with('error', 'Bad credentials');
        }

    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login')->with('success', 'Logged Out Successfully');
    }
}