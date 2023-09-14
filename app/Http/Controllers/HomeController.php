<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public $uid = 0;    // userid
    public $token;

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $this->uid = $request->session()->get('user_data')->id;
            return $next($request);
        });
        // TODO : WIP
        if (request()->hasCookie('udata')) {
            $cook = $request->cookie('udata');
            //dump($cook);
            try {
                $decrypted = Crypt::decryptString($cook);
                //dump($decrypted);
            } catch (DecryptException $e) {
                //dump($e);
                return redirect()->route('logout')->with('failed', 'Decrypt exception');
            }
            //$this->token = $sess->token;
        } else {
            //dump('Cookie not found');
            //return redirect()->route('logout')->with('failed', 'Cookie not found');
        }
    }

    public function index()
    {
        return view('dashboard');
    }
}
