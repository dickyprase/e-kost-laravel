<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . auth()->id(),
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'nik' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:50',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'password' => 'nullable|string|min:8|confirmed', // Jika password diubah
        ]);
    
        $user = auth()->user();
        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);
    
        return redirect()->route('profile.edit')->with('status', 'Profile updated!');
    }
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
