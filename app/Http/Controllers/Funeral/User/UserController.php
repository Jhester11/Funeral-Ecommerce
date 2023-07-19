<?php

namespace App\Http\Controllers\Funeral\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /// for registering new user
    public function create(Request $request)
    {
        // Validation Inputs
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:30',
            'password_confirmation' => 'required|min:5|max:30|same:password',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();
        $last_id = $user->id;

        $token = $last_id . hash('sha256', Str::random(120));
        $verifyURL = route('user.verify', ['token' => $token, 'service' => 'Email_verification']);

        VerifyUser::create([
            'user_id' => $last_id,
            'token' => $token,
        ]);

        $message1 = 'Dear <b>' . $request->name . '</b>';
        $message = 'Thanks for signing up, we just need you to verify your email address to complete setting up your account.';

        $mail_data = [
            'recipient' => $request->email,
            'fromEmail' => $request->email,
            'fromName' => $request->name,
            'subject' => 'email Verification',
            'name' => $message1,
            'body' => $message,
            'actionLink' => $verifyURL,
        ];

        Mail::send('email-template', $mail_data, function ($message) use ($mail_data) {
            $message->to($mail_data['recipient'])
                ->from($mail_data['fromEmail'], $mail_data['fromName'])
                ->subject($mail_data['subject']);
        });

        if ($save) {
            return redirect('/user/login')->with('info', 'You need to verify your account. We have sent you an activation link, please check your email.');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        }
    }

    // Verify the account
    public function verify(Request $request)
    {
        $token = $request->token;
        $verifyUser = VerifyUser::where('token', $token)->first();
        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->email_verified) {
                $verifyUser->user->email_verified = 1;
                $verifyUser->user->save();
                return redirect()->route('user.login')->with('info', 'Your email is verified successfully. You can now login')->with('verifiedEmail', $user->email);
            } else {
                return redirect()->route('user.login')->with('info', 'Your email is already verified. You can now login')->with('verifiedEmail', $user->email);
            }
        }
    }

    // Checking if the account is exixts
    public function check(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:5|max:30',
            ],
            [
                'email.exists' => 'This email is not exists'
            ]
        );

        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('user.homepage');
        } else {
            return redirect()->route('user.login')->with('fail', 'Incorrect Information');
        }
    }

    // Form Forgot Password
    public function showForgotForm()
    {
        return view('funeral.user.forgot');
    }

    // Forgot password
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        $token = \Str::random(64);
        \DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $action_link = route('user.reset.password.form', ['token' => $token, 'email' => $request->email]);
        $body = "We are received a request to reset the password for <b> Funeral E-commerce </b> account associated with " . $request->email . ". You can reset your password by clicking the link below";

        \Mail::send('email-forgot', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request) {
            $message->from('teniosobalangue96@gmail.com', 'Funeral E-commerce');
            $message->to($request->email, 'Your name')
                ->subject('Reset Password');
        });

        return back()->with('info', 'We have e-mailed your password reset link!');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('funeral.user.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $check_token = \DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$check_token) {
            return back()->withInput()->with('fail', 'Invalid token');
        } else {
            User::where('email', $request->email)->update([
                'password' => \Hash::make($request->password)
            ]);

            \DB::table('password_resets')->where([
                'email' => $request->email
            ])->delete();

            return redirect()->route('user.login')->with('info', 'Your password has been changed! You can now login with new password')->with('verifiedEmail', $request->email);
        }
    }

    // Logout User
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
