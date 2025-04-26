<?php


namespace Tests\Feature;

use App\Models\Client;
use App\Models\CreditApplication;
use App\Models\Phone;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreditApplicationFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_credit_application_approves_credit_and_creates_instalments_and_decreases_stock()
    {
        // Crear cliente y teléfono
        $client = Client::factory()->create();
        $phone = Phone::factory()->create([
            'stock' => 3,
            'price' => 1200000,
        ]);

        // Enviar solicitud POST
        $response = $this->postJson('/api/credits', [
            'client_id' => $client->id,
            'phone_id' => $phone->id,
            'term_months' => 6,
        ]);

        // Verificar que la solicitud fue exitosa
        $response->assertStatus(200)
                 ->assertJsonStructure(['message', 'application_id']);

        $applicationId = $response->json('application_id');

        // Verificar que el crédito fue creado y aprobado
        $this->assertDatabaseHas('credit_applications', [
            'id' => $applicationId,
            'client_id' => $client->id,
            'phone_id' => $phone->id,
            'state' => 'approved',
        ]);

        // Verificar que se crearon las 6 cuotas
        $this->assertDatabaseCount('instalments', 6);

        // Verificar que el stock del teléfono se descontó
        $this->assertDatabaseHas('phones', [
            'id' => $phone->id,
            'stock' => 2,
        ]);
    }
}


