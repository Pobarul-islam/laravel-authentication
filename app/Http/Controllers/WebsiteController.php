<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function settings()
    {
        return view('settings');
    }

    public function login()
    {
        return view('login');
    }

    public function login_submit(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'Active',

        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login');
        }
    }



    public function logout()
    {
        Auth::guard()->logout();

        return redirect()->route('login');
    }
    public function registration()
    {
        return view('registration');
    }

    public function registration_submit(Request $request)
    {

        $token = hash('sha256', time());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 'Pending';
        $user->token = $token;
        $user->role = 2;
        $user->save();

        $verification_link = url('registration/verify/' . $token . '/' . $request->email);
        $subject = 'Registration Confirmation';
        $message = 'Please click on this link: <br><a href="' . $verification_link . '">Click here</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        echo 'Email is sent';
    }

    public function registration_verify($token, $email)
    {
        $user = User::where('token', $token)->where('email', $email)->first();
        if (!$user) {
            return redirect()->route('login');
        }

        $user->status = 'Active';
        $user->token = '';
        $user->update();
        echo 'Registration verified successfully !';
    }


    public function forget_password()
    {
        return view('forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $token = hash('sha256', time());
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            dd('Email not found');
        }
        $user->token = $token;
        $user->update();
        $reset_link = url('reset_password' . '/' . $token . '/' . $request->email);
        $subject = 'Reset Password';
        $message = 'Please Click on the link: <a href="' . $reset_link . '">Click here</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));
        echo 'Check you email';
    }

    public function reset_password($token, $email)
    {
        $user = User::where('token', $token)->where('email', $email)->first();
        if (!$user) {
            return redirect()->route('login');
        }
        return view('reset_password', compact('token', 'email'));
    }


    public function reset_password_submit(Request $request)
    {
        $user = User::where('token', $request->token)->where('email', $request->email)->first();
        $user->token = "";
        $user->password = Hash::make($request->new_password);
        $user->update();
        echo 'Password is Reset Success';
    }
}
