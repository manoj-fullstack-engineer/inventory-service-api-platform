<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    public function showLinkRequestForm()
    {
        return view('auth.forgotPassword'); // Adjust the view path as needed
    }

    public function tempPasswordRequest(Request $request)
    {
        // Validate the email
        $request->validate(['email' => 'required|email']);

        // Find the user by email
        
        $user = User::where('email', $request->email)->first();
        
        info("\nForgot password starts..");
        info($request->email);
        // If user not found, return an error
        if (!$user) {
            return back()->withErrors(['email' => 'Email not found.'])->withInput();
        }

        // Generate a temporary password
        $temporaryPassword = Str::random(10);

        // Update the user's password to the temporary one
        $user->password = Hash::make($temporaryPassword);
        $user->save();

        // Send the temporary password via email
        Mail::send('emails.temporary_password', ['temporaryPassword' => $temporaryPassword], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Your Temporary Password');
        });

        // Return a success message
        return back()->with('status', 'A temporary password has been sent to your email.');
    }

    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

}
