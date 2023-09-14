<?php

namespace App\Http\Controllers;

use App\Services\LogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests\EventRequest;

use App\Helpers\PageHelper;
use App\Services\EventService;
use App\Services\OrganizerService;

class EventController extends Controller
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
        $response = EventService::getIndex($request);
        if ($response->ok()) {

            $result = PageHelper::paginate($response, $request);
            return view('event', $result);
        } else {
            $err = json_decode($response->body());
            //dd($err);
            return redirect()->route('admin.dashboard')->with('failed', 'Invalid API response');
        }
    }

    public function create()
    {
        $response = OrganizerService::get();
        if ($response->ok()) {
            $res = json_decode($response->body());
            $params = [
                'orgs' => $res->data,
            ];
        } else {
            $err = json_decode($response->body());
            //return redirect()->route('admin.dashboard')->with('failed', 'Invalid API response');
        }

        return view('event-create', $params);
    }

    public function store(EventRequest $request): RedirectResponse
    {
        // validation
        $validated = $request->validated();

        $endpoint = config('api.url_event');
        $body = [
            "eventDate" => $validated['inputDate'],
            "eventName" => $validated['inputName'],
            "eventType" => $validated['inputType'],
            "organizerId" => $validated['inputOrgId']
        ];

        $response = EventService::post($body);
        if ($response->ok()) {
            // Log
            $logservice = new LogService();
            $log = [
                'table_name' => 'sports-event',
                'type' => 'C',
                'datetime' => date('Y-m-d h:i:s'),
                'log' => json_encode($body),
                'userid' => $this->uid,
                'endpoint' => $endpoint,
            ];
            $logservice->setLogData($log);
            $logservice->insertLogData();

            return redirect()->route('admin.event.index')->with('success', 'Create Organizer Success');
        } else {
            $err = json_decode($response->body());
            //dd($err);
            return redirect()->route('admin.dashboard')->with('failed', 'Invalid API response');
        }
    }

    public function edit($id)
    {
        $response = EventService::getById($id);
        if ($response->ok()) {
            $res = json_decode($response->body());
            $params = [
                'data' => $res
            ];

            $orgResponse = OrganizerService::get();
            if ($orgResponse->ok()) {
                $res = json_decode($orgResponse->body());
                $params['orgs'] = $res->data;
            }

            return view('event-edit', $params);
        } else {
            $err = json_decode($response->body());
            //dd($err);
            return redirect()->route('admin.dashboard')->with('failed', 'Invalid API response');
        }
    }

    public function update(EventRequest $request, $id): RedirectResponse
    {
        // validation
        $validated = $request->validated();

        $endpoint = config('api.url_event') . '/' . $id;
        $body = [
            "eventDate" => $validated['inputDate'],
            "eventName" => $validated['inputName'],
            "eventType" => $validated['inputType'],
            "organizerId" => $validated['inputOrgId']
        ];

        $response = EventService::put($body, $id);
        if ($response->successful()) {
            // Log
            $logservice = new LogService();
            $log = [
                'table_name' => 'sports-event',
                'type' => 'U',
                'datetime' => date('Y-m-d h:i:s'),
                'id' => $id,
                'log' => json_encode($body),
                'userid' => $this->uid,
                'endpoint' => $endpoint,
            ];
            $logservice->setLogData($log);
            $logservice->insertLogData();

            return redirect()->route('admin.event.index')->with('success', 'Update Organizer Success');
        } else {
            $err = json_decode($response->body());
            //dd($err);
            return redirect()->route('admin.dashboard')->with('failed', 'Invalid API response');
        }
    }

    public function delete($id): RedirectResponse
    {
        $endpoint = config('api.url_event') . '/' . $id;

        $response = EventService::delete($id);
        if ($response->successful()) {
            // Log
            $body['id'] = $id;
            $logservice = new LogService();
            $log = [
                'table_name' => 'sports-event',
                'type' => 'D',
                'datetime' => date('Y-m-d h:i:s'),
                'id' => $id,
                'log' => json_encode($body),
                'userid' => $this->uid,
                'endpoint' => $endpoint,
            ];
            $logservice->setLogData($log);
            $logservice->insertLogData();

            return redirect()->route('admin.event.index')->with('success', 'Delete Organizer Success');
        } else {
            $err = json_decode($response->body());
            //dd($err);
            return redirect()->route('admin.dashboard')->with('failed', 'Invalid API response');
        }
    }
}
