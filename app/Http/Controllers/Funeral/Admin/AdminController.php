<?php

namespace App\Http\Controllers\Funeral\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|max:30',
        ],
        [
            'email.exists'=>'This email is not exists'
        ]);

        $credentials = $request->only('email','password');
        if(Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->withSuccess('Congratulations! You may see your dashboard.');
        }
        else {
            return redirect()->route('learning.login')->withWarning('Incorrect Information');
        }
    }

    // logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
