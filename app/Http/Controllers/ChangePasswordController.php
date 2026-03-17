<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    /**
     * Show the form for changing the password.
     *
     * @return \Illuminate\View\View
     */
    public function showChangePasswordForm()
    {
        return view('auth.change-password', ['message' => '']); // The Blade view for the password change form
    }

    /**
     * Handle the password change request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        // Validate the form input
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // If validation fails, redirect back with errors and input
        if ($validator->fails()) {
            return redirect()->route('password.change')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Check if the current password is correct
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->route('password.change')
                             ->withErrors(['current_password' => 'The current password is incorrect.'])
                             ->withInput();
        }

        // Update the password
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirect with success message
        return redirect()->route('password.change')->with('status', 'Password changed successfully.');
    }
}
