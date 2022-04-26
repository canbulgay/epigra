<?php

namespace Tests\Feature;

use App\Models\Capsule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CapsuleTest extends TestCase
{
    use WithFaker;
    /**
     * Display a listing of capsules with authenticate user.
     * 
     * @return void
     */
    public function test_display_listing_of_capsules_with_authenticate_user()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->getJson('/api/capsules');

        $response->assertStatus(200);
    }

    /**
     * Display a listing of capsules without authenticate user.
     * 
     * @return void
     */
    public function test_display_listing_of_capsules_without_authenticate_user()
    {
        $response = $this->getJson('/api/capsules');

        $response->assertStatus(401);
    }

    /**
     * Display capsule detail with authenticate user.
     * 
     * @return void
     */
    public function test_display_capsule_detail_with_authenticate_user()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $capsule = Capsule::first();
        $response = $this->getJson('/api/capsules/' . $capsule->capsule_serial);

        $response->assertStatus(200);
    }

    /**
     * Display capsule detail without authenticate user.
     * 
     * @return void
     */
    public function test_display_capsule_detail_without_authenticate_user()
    {
        $capsule = Capsule::first();
        $response = $this->getJson('/api/capsules/' . $capsule->capsule_serial);

        $response->assertStatus(401);
    }

    /**
     * Display capsule detail with invalid capsule serial.
     * 
     * @return void
     */
    public function test_display_capsule_detail_with_invalid_capsule_serial()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->getJson('/api/capsules/invalid-capsule-serial');

        $response->assertStatus(404);
    }

    /**
     * Display a list of capsules with status.
     * 
     * @return void
     */
    public function test_display_list_of_capsules_with_status()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );
        $status = ['active', 'unknown', 'retired'];
        $response = $this->getJson('/api/' . $this->faker()->randomElement($status) . '/capsules');

        $response->assertStatus(200);
    }

    /**
     * Display a list of capsules with status without authenticate user.
     * 
     * @return void
     */
    public function test_display_list_of_capsules_with_status_without_authenticate_user()
    {
        $status = ['active', 'unknown', 'retired'];
        $response = $this->getJson('/api/' . $this->faker()->randomElement($status) . '/capsules');

        $response->assertStatus(401);
    }
}
