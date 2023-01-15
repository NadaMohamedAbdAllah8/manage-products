<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
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
        $admin = Admin::where('name', $fields['name'])->first();

        // Check password
        if (! $admin || ! Hash::check($fields['password'], $admin->password)) {
            return back()->with('error', 'Bad credentials');
        }

        // Login
        if (Auth::guard('admin')->attempt(['name' => request('name'),
            'password' => request('password')])) {
            return redirect()->route('admin.index')
                ->with('success', 'Logged In Successfully');
        } else {
            return back()->with('error', 'Bad credentials');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login')->with('success', 'Logged Out Successfully');
    }
}
