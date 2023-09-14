<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function setCookie($data)
    {
        $response = response('Set Cookie');
        $response->withCookie('cookie_data', json_encode($data), config('session.lifetime'));
        return $response;
    }

    public function getCookie()
    {
        return json_decode(request()->cookie('cookie_data'));
    }

    public function delCookie()
    {
        return response('deleted')->cookie('cookie_data', null, 1);
    }
}
