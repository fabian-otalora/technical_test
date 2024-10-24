<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SecurityPriceJob;

class SecurityPriceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test the function syncSecurityPrices if the security type exists
     */
    public function testSyncSecurityPrices()
    {
        $param = [
            'security_type' => '1'
        ];

        // Send a POST request
        $response = $this->post('/api/syncing_security_prices', $param);

        // Assert that the request was successful (status code 201)
        $response->assertStatus(201);
    }

    /**
     * Test the function syncSecurityPrices if the security type not exists
     */
    public function testNotExistSecurityType()
    {
        $param = [
            'security_type' => '999'
        ];

        // Send a POST request
        $response = $this->post('/api/syncing_security_prices', $param);

        // Assert that the request was successful (status code 201)
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'status' => 201,
            'sync' => "Security type not found",
        ]);

    }

    /**
     * Test SecurityRequest validator
     */
    public function testValidationRequest()
    {
        $param = [
            'security_type' => 'abcdef'
        ];

        // Send a POST request
        $response = $this->post('/api/syncing_security_prices', $param);

        // Assert that the request was successful (status code 201)
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'success' => false,
            'message' => "Validation errors",
        ]);
    }

    /**
     * Test Assert a job was pushed.
     */
    public function testJobSecurityPriceJob()
    {
        Queue::fake();
        SecurityPriceJob::dispatch();
        Queue::assertPushed(SecurityPriceJob::class);
    }
}
