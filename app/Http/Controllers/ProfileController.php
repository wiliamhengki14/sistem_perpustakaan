<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    //
    public function show_profile() {
        $user = Auth::user();
        return view('show_profile', compact('user'));
    }
    public function edit_profile() {
        $user = Auth::user();
        return view('edit_profile', compact('user'));
    }
    public function update_profile(Request $request) {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|min:8|string|confirmed'
        ]);
        /** @var \App\Models\User $user */
        if($request->filled('password')) {
            $password = Hash::make($request->password);
        }else {
            $password = $user->password;
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password
        ]);
        return Redirect::route('show_profile');
    }
}
