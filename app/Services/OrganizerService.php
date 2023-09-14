<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OrganizerService
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

    public static function getSession()
    {
        $response = [];
        if (request()->session()->has('user_data')) {
            $sess = request()->session()->get('user_data');
            $token = $sess->token;
            $uid = $sess->id;

            $response = [
                'token' => $token,
                'uid' => $uid
            ];
        }
        return $response;
    }

    public static function getIndex($request)
    {
        $endpoint = config('api.url_org');
        $sess_data = self::getSession();
        $options = self::getOption();

        $response = Http::withToken($sess_data['token'])->withOptions($options)->get($endpoint, ['page' => $request->page]);
        return $response;
    }

    public static function get()
    {
        $endpoint = config('api.url_org');
        $sess_data = self::getSession();
        $options = self::getOption();

        $response = Http::withToken($sess_data['token'])->withOptions($options)->get($endpoint);
        return $response;
    }

    public static function getById($id)
    {
        $endpoint = config('api.url_org') . '/' . $id;
        $sess_data = self::getSession();
        $options = self::getOption();

        $response = Http::withToken($sess_data['token'])->withOptions($options)->get($endpoint);
        return $response;
    }

    public static function post($body)
    {
        $endpoint = config('api.url_org');
        $sess_data = self::getSession();
        $options = self::getOption();

        $response = Http::withToken($sess_data['token'])->withOptions($options)->post($endpoint, $body);
        return $response;
    }

    public static function put($body, $id)
    {
        $endpoint = config('api.url_org') . '/' . $id;
        $sess_data = self::getSession();
        $options = self::getOption();

        $response = Http::withToken($sess_data['token'])->withOptions($options)->put($endpoint, $body);
        return $response;
    }

    public static function delete($id)
    {
        $endpoint = config('api.url_org') . '/' . $id;
        $sess_data = self::getSession();
        $options = self::getOption();

        $response = Http::withToken($sess_data['token'])->withOptions($options)->delete($endpoint);
        return $response;
    }
}
