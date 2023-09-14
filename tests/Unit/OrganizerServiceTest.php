<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use App\Services\OrganizerService;
use Tests\TestCase;

class OrganizerServiceTest extends TestCase
{
    public function test_service_can_get_index(Request $request)
    {
        $org_service = OrganizerService::getIndex($request);

        $this->assertIsObject($org_service);
    }

    public function test_service_failed_get_index()
    {
        $org_service = OrganizerService::getIndex([]);

        $this->assertIsObject($org_service);
    }

    public function test_service_can_get()
    {
        $org_service = OrganizerService::get();

        $this->assertIsObject($org_service);
    }

    public function test_service_can_get_by_id()
    {
        $id = 1;
        $org_service = OrganizerService::getById($id);

        $this->assertIsObject($org_service);
    }

    public function test_service_failed_get_by_id()
    {
        $id = 0;
        $org_service = OrganizerService::getById($id);

        $this->assertIsObject($org_service);
    }

    public function test_service_can_post()
    {
        $body = [
            "organizerName" => "Test 1",
            "imageLocation" => "Loc 1",
        ];
        $org_service = OrganizerService::post($body);

        $this->assertIsObject($org_service);
    }

    public function test_service_failed_post()
    {
        $body = [
            "organizerName" => null,
            "imageLocation" => null,
        ];
        $org_service = OrganizerService::post($body);

        $this->assertIsObject($org_service);
    }

    public function test_service_can_put()
    {
        $id = 1;
        $body = [
            "organizerName" => "Test 1",
            "imageLocation" => "Loc 1",
        ];
        $org_service = OrganizerService::put($body, $id);

        $this->assertIsObject($org_service);
    }

    public function test_service_failed_put()
    {
        $id = 0;
        $body = [
            "organizerName" => null,
            "imageLocation" => null,
        ];
        $org_service = OrganizerService::put($body, $id);

        $this->assertIsObject($org_service);
    }

    public function test_service_can_delete()
    {
        $id = 1;
        $org_service = OrganizerService::delete($id);

        $this->assertIsObject($org_service);
    }

    public function test_service_failed_delete()
    {
        $id = 0;
        $org_service = OrganizerService::delete($id);

        $this->assertIsObject($org_service);
    }
}
