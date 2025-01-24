<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class Adminregidtion extends Controller
{
    public function addUsernewadmin(Request $request)
    {
        $messages = [
            'name.required' => 'The full name is required.',
            'name.string' => 'The full name must be a string.',
            'name.max' => 'The full name may not be greater than 255 characters.',
            'phoneNUM.required' => 'The phone number is required.',
            'phoneNUM.string' => 'The phone number must be a string.',
            'phoneNUM.max' => 'The phone number may not be greater than 15 characters.',
            'userDP.required' => 'Please upload a profile image.',
            'userDP.file' => 'The profile image must be a file.',
            'userDP.image' => 'The profile image must be an image.',
            'userDP.max' => 'The profile image may not be larger than 1MB.',
            'usertype.nullable' => 'The user role is required.',
            'gender.nullable' => 'The gender is required.',
            'gender.in' => 'Please select a valid gender (male, female, other).',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'email.unique' => 'The email address is already taken.',
            'password.required' => 'The password is required.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password must be at least 8 characters long.',
        ];
        $request->validate([
            'name' => 'required|string|max:255',
            'phoneNUM' => 'required|string|max:15',
            'userDP' => 'required',
            'usertype' => 'required',
            'image',
            'gender' => 'nullable|string|in:male,female,other',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], $messages);
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
        session()->flash('success', 'User created successfully.');
        return redirect()->back();
    }
    public function userechenges(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
            return redirect()->back()->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update user: ' . $e->getMessage());
        }
    }
}
