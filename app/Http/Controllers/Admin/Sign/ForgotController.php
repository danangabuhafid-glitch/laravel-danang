<?php

namespace App\Http\Controllers\Admin\Sign;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotController extends Controller
{
    /**
     * Show the forgot password form based on current step.
     */
    public function showForgotForm()
    {
        if (session()->has('forgot_verified_user_id')) {
            $step = 3;
        } elseif (session()->has('forgot_username')) {
            $step = 2;
        } else {
            $step = 1;
        }

        return view('admin.sign.forgot', compact('step'));
    }

    /**
     * Handle the multi-step forgot password form submission.
     */
    public function handleForgot(Request $request)
    {
        $step = $request->input('step');

        if ($step == 1) {
            $request->validate([
                'username' => 'required|string|max:255',
            ]);

            $user = User::where('username', $request->username)->first();

            if (!$user) {
                return redirect()->back()->withErrors(['username' => 'Username not found in our records.'])->withInput();
            }

            session(['forgot_username' => $user->username]);
            return redirect()->route('forgot')->with('success', 'Username verified! Please enter your registered email.');
        } 
        
        if ($step == 2) {
            $request->validate([
                'email' => 'required|email|max:255',
            ]);

            $username = session('forgot_username');
            if (!$username) {
                return redirect()->route('forgot.reset');
            }

            $user = User::where('username', $username)->first();

            if (!$user || strtolower($user->email) !== strtolower($request->email)) {
                return redirect()->back()->withErrors(['email' => 'The email entered does not match the registered email for this username.'])->withInput();
            }

            session(['forgot_verified_user_id' => $user->id]);
            return redirect()->route('forgot')->with('success', 'Email verified! Please set your new password.');
        } 
        
        if ($step == 3) {
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);

            $userId = session('forgot_verified_user_id');
            if (!$userId) {
                return redirect()->route('forgot.reset');
            }

            $user = User::findOrFail($userId);
            $user->password = Hash::make($request->password);
            $user->save();

            // Clear temporary session data
            session()->forget(['forgot_username', 'forgot_verified_user_id']);

            return redirect()->route('signin')->with('success', 'Your password has been successfully updated. Please login with your new password.');
        }

        return redirect()->route('forgot');
    }

    /**
     * Reset the forgot password process.
     */
    public function resetForgot()
    {
        session()->forget(['forgot_username', 'forgot_verified_user_id']);
        return redirect()->route('forgot');
    }
}
