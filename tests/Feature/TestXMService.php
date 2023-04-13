<?php

namespace Tests\Feature;

use App\Services\APIService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TestXMService extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_get_company_name()
    {
        $apiService = $this->getMockBuilder(APIService::class)
                        ->disableOriginalConstructor()
                        ->getMock();

        $result = $apiService->getCompanyName("AAPL");

        $this->assertNotEmpty($result);

    }
}
