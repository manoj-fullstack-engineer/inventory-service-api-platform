<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use App\User;
use App\Mail\TemporaryPasswordMail;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $tempPassword = $this->generateTemporaryPassword();
            $user->password = Hash::make($tempPassword);
            $user->save();

            Mail::to($user->email)->send(new TemporaryPasswordMail($tempPassword));

            return response()->json(['message' => 'Temporary password sent to your email.']);
        }

        return response()->json(['error' => 'User not found.'], 404);
    }

    private function generateTemporaryPassword()
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
    }
}
