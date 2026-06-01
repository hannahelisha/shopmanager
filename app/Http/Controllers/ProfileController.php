<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // show profile page
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // update profile info
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'gender' => 'nullable',
            'address' => 'nullable',
            'ice_cream_preference' => 'nullable',
            'serving_preference' => 'nullable',
            'topping_preference' => 'nullable',
            'flavor_suggestion' => 'nullable',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 4 avatar upload
        if ($request->hasFile('avatar')) 
        {
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('avatars'), $avatarName);
            $user->avatar = $avatarName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->ice_cream_preference = $request->ice_cream_preference;
        $user->serving_preference = $request->serving_preference;
        $user->topping_preference = $request->topping_preference;
        $user->flavor_suggestion = $request->flavor_suggestion;
        $user->save();

        return redirect()->route('profile')
            ->with('success', 'Profile updated successfully! 🍦');
    }

    // update pass
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect!');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile')
            ->with('success', 'Password updated successfully! 🔐');
    }
}