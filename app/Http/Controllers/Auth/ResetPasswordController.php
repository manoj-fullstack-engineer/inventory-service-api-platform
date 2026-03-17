<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    // Display the password reset form
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Handle the password reset request
    public function reset(Request $request)
    {
        $this->validator($request->all())->validate();

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
                    ? redirect($this->redirectPath())
                        ->with('status', __($response))
                    : redirect()->back()
                        ->withErrors(['email' => [__($response)]]);
    }

    // Get the password broker instance
    protected function broker()
    {
        return Password::broker();
    }

    // Get the reset credentials from the request
    protected function credentials(Request $request)
    {
        return $request->only('email', 'password', 'password_confirmation', 'token');
    }

    // Reset the given user's password
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();

        $this->guard()->login($user);
    }

    // Get the guard to be used during password reset
    protected function guard()
    {
        return Auth::guard();
    }

    // Get the redirect path after password reset
    protected function redirectPath()
    {
        return '/home';
    }

    // Validate the password reset form
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ]);
    }
}
