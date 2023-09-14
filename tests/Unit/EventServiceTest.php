<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use App\Services\EventService;
use Tests\TestCase;

class EventServiceTest extends TestCase
{
    public function test_service_can_get_index(Request $request)
    {
        $event_service = EventService::getIndex($request);

        $this->assertIsObject($event_service);
    }

    public function test_service_failed_get_index()
    {
        $event_service = EventService::getIndex([]);

        $this->assertIsObject($event_service);
    }

    public function test_service_can_get()
    {
        $event_service = EventService::get();

        $this->assertIsObject($event_service);
    }

    public function test_service_can_get_by_id()
    {
        $id = 1;
        $event_service = EventService::getById($id);

        $this->assertIsObject($event_service);
    }

    public function test_service_failed_get_by_id()
    {
        $id = 0;
        $event_service = EventService::getById($id);

        $this->assertIsObject($event_service);
    }

    public function test_service_can_post()
    {
        $body = [
            "eventDate" => "2023-09-13",
            "eventName" => "Test Event",
            "eventType" => "Test Type",
            "organizerId" => 50
        ];
        $event_service = EventService::post($body);

        $this->assertIsObject($event_service);
    }

    public function test_service_failed_post()
    {
        $body = [
            "eventDate" => null,
            "eventName" => null,
            "eventType" => null,
            "organizerId" => 0
        ];
        $event_service = EventService::post($body);

        $this->assertIsObject($event_service);
    }

    public function test_service_can_put()
    {
        $id = 1;
        $body = [
            "eventDate" => "2023-09-13",
            "eventName" => "Test Event",
            "eventType" => "Test Type",
            "organizerId" => 50
        ];
        $event_service = EventService::put($body, $id);

        $this->assertIsObject($event_service);
    }

    public function test_service_failed_put()
    {
        $id = 0;
        $body = [
            "eventDate" => null,
            "eventName" => null,
            "eventType" => null,
            "organizerId" => 0
        ];
        $event_service = EventService::put($body, $id);

        $this->assertIsObject($event_service);
    }

    public function test_service_can_delete()
    {
        $id = 1;
        $event_service = EventService::delete($id);

        $this->assertIsObject($event_service);
    }

    public function test_service_failed_delete()
    {
        $id = 0;
        $event_service = EventService::delete($id);

        $this->assertIsObject($event_service);
    }
}
