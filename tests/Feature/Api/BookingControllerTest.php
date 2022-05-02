<?php

namespace Tests\Feature\Api;

use App\Traits\IncrementDateTimeTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use JMac\Testing\Traits\AdditionalAssertions;
use App\Models\User;
use App\Models\MovieBooking;
use Laravel\Sanctum\Sanctum;

/**
 * Testing controllers for api calls
 */
class BookingControllerTest extends TestCase
{
    use IncrementDateTimeTrait, DatabaseTransactions, AdditionalAssertions;

    /**
     * base url for controller
     * @var string
     */
    private string $baseUrl = '/api/bookings';

    /**
     * Test middleware for controller
     */
    public function testMiddleware()
    {
        $this->assertRouteUsesMiddleware(
            'bookings',
            ['api', 'auth:sanctum']
        );

        $this->assertRouteUsesMiddleware(
            'bookings.store',
            ['api', 'auth:sanctum']
        );

        $this->assertRouteUsesMiddleware(
            'bookings.cancel',
            ['api', 'auth:sanctum']
        );
    }

    public function testIndex()
    {
        //User login
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->get($this->baseUrl);

        //Test response success
        $response->assertSuccessful();
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "success",
            "data" => [
                '*' => [
                    "id",
                    "start_time",
                    "end_time",
                    "movie_name",
                    "unique_ref",
                    "no_tickets",
                ]
            ],
            "message"
        ]);
    }

    public function testStore()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->post($this->baseUrl . '/store', ['play_id' => 4, 'no_tickets' => 1]);

        //Test response success
        $response->assertSuccessful();
        $response->assertStatus(201)
            ->assertExactJson([
                'data' => [],
                'message' => 'Action completed successfully',
                'success' => true
            ]);
    }

    public function testCancelBooking()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $mb = MovieBooking::first();
        if(isset($mb)){
            $response = $this->post($this->baseUrl . '/cancel', ['id' => $mb->id]);
            //Test response success
            $response->assertStatus(200)
                ->assertExactJson([
                    'data' => [],
                    'message' => 'Booking was successfully cancelled',
                    'success' => true
                ]);
        }

    }
}
