<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Cookie;

use App\Http\Requests\LoginRequest;
use App\Services\LoginService;

class LoginController extends Controller
{
    public function __construct() {}

    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(LoginRequest $request): RedirectResponse
    {
        // validation
        $validated = $request->validated();

        $body = [
            "email" => $validated['email'],
            "password" => $validated['password'],
        ];

        $response = LoginService::post($body);
        if ($response->ok()) {
            $data = json_decode($response->body());
            // with cookie
            $cookie = cookie($response->body());

            // store payload to session
            session(['user_data' => $data]);
            if ($request->session()->has('user_data') && config('app.env') == 'local') {
                $sess = $request->session()->get('user_data');
                //dump($sess);
            }
            //return redirect()->route('admin.dashboard');
            return redirect()->route('admin.dashboard')->withCookie('udata', $cookie, 15);
        } else {
            $err = json_decode($response->body());
            //dd($err);
            return redirect()->route('login')->with('failed', 'Sorry. Invalid login');
        }
    }

    public function logout()
    {
        // clear
        Cookie::forget('udata');
        session()->forget('user_data');
        session()->flush();
        return redirect()->route('login')->with('success', 'Logout success');
    }
}
