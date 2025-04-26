<?php

namespace Tests\Unit;
use App\Helpers\CreditEligibility;
use App\Models\Client;
use App\Models\CreditApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function Psy\debug;

class CreditEligibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_with_active_credit_is_not_eligible()
    {
        $client = Client::factory()->create();

        debug($client);
        CreditApplication::factory()->create([
            'client_id' => 1,//$client->id
            'phone_id' => 1,
            'state' => 'approved', // o 'pending'
        ]);

        $this->assertTrue(CreditEligibility::hasActiveCredit($client->id));
    }

    public function test_client_with_no_active_credit_is_eligible()
    {
        $client = Client::factory()->create();

        // Crédito rechazado, no cuenta como activo
        CreditApplication::factory()->create([
            'client_id' => 1,//$client->id,
            'state' => 'rejected',
        ]);

        $this->assertFalse(CreditEligibility::hasActiveCredit($client->id));
    }
}

