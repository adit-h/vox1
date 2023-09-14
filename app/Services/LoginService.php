<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LoginService
{
    public static function getOption()
    {
        $options = [];
        if (config('app.env') == 'local') {
            $options = [
                'verify' => false
            ];
        }
        return $options;
    }

    public static function post($body)
    {
        $endpoint = config('api.url_login');
        $options = self::getOption();

        $response = Http::withOptions($options)->post($endpoint, $body);
        return $response;
    }

}
