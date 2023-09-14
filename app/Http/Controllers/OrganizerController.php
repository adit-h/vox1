<?php

namespace App\Http\Controllers;

use App\Services\LogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests\OrganizerRequest;

use App\Helpers\PageHelper;
use App\Services\OrganizerService;

class OrganizerController extends Controller
{
    public $uid = 0;    // userid
    public $options = [];

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->uid = $request->session()->get('user_data')->id;
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $response = OrganizerService::getIndex($request);
        if ($response->ok()) {

            $result = PageHelper::paginate($response, $request);
            return view('organizer', $result);
        } else {
            $err = json_decode($response->body());
            //dd($err);
            return redirect()->route('admin.dashboard')->with('failed', 'Invalid API response');
        }
    }

    public function create()
    {
        return view('organizer-create');
    }

    public function store(OrganizerRequest $request): RedirectResponse
    {
        // validation
        $validated = $request->validated();

        $endpoint = config('api.url_org');
        $body = [
            "organizerName" => $validated['inputOrganizer'],
            "imageLocation" => $validated['inputLocation'],
        ];

        $response = OrganizerService::post($body);
        if ($response->ok()) {
            // Log
            $logservice = new LogService();
            $log = [
                'table_name' => 'organizer',
                'type' => 'C',
                'datetime' => date('Y-m-d h:i:s'),
                'log' => json_encode($body),
                'userid' => $this->uid,
                'endpoint' => $endpoint,
            ];
            $logservice->setLogData($log);
            $logservice->insertLogData();

            return redirect()->route('admin.organizer.index')->with('success', 'Create Organizer Success');
        } else {
            $err = json_decode($response->body());
            //dd($err);
            return redirect()->route('admin.dashboard')->with('failed', 'Invalid API response');
        }
    }

    public function edit($id)
    {
        $response = OrganizerService::getById($id);
        if ($response->ok()) {
            $res = json_decode($response->body());
            $params = [
                'data' => $res
            ];
            return view('organize-edit', $params);
        } else {
            $err = json_decode($response->body());
            //dd($err);
            return redirect()->route('admin.dashboard')->with('failed', 'Invalid API response');
        }
    }

    public function update(OrganizerRequest $request, $id): RedirectResponse
    {
        // validation
        $validated = $request->validated();

        $endpoint = config('api.url_org') . '/' . $id;
        $body = [
            "organizerName" => $validated['inputOrganizer'],
            "imageLocation" => $validated['inputLocation'],
        ];

        $response = OrganizerService::put($body, $id);
        if ($response->successful()) {
            // Log
            $body['id'] = $id;
            $logservice = new LogService();
            $log = [
                'table_name' => 'organizer',
                'type' => 'U',
                'datetime' => date('Y-m-d h:i:s'),
                'id' => $id,
                'log' => json_encode($body),
                'userid' => $this->uid,
                'endpoint' => $endpoint,
            ];
            $logservice->setLogData($log);
            $logservice->insertLogData();

            return redirect()->route('admin.organizer.index')->with('success', 'Update Organizer Success');
        } else {
            $err = json_decode($response->body());
            //dd($err);
            return redirect()->route('admin.dashboard')->with('failed', 'Invalid API response');
        }
    }

    public function delete($id): RedirectResponse
    {
        $endpoint = config('api.url_org') . '/' . $id;

        $response = OrganizerService::delete($id);
        if ($response->successful()) {
            // Log
            $body['id'] = $id;
            $logservice = new LogService();
            $log = [
                'table_name' => 'organizer',
                'type' => 'D',
                'datetime' => date('Y-m-d h:i:s'),
                'id' => $id,
                'log' => json_encode($body),
                'userid' => $this->uid,
                'endpoint' => $endpoint,
            ];
            $logservice->setLogData($log);
            $logservice->insertLogData();

            return redirect()->route('admin.organizer.index')->with('success', 'Delete Organizer Success');
        } else {
            $err = json_decode($response->body());
            //dd($err);
            return redirect()->route('admin.dashboard')->with('failed', 'Invalid API response');
        }
    }
}
