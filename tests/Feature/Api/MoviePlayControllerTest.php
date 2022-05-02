<?php
namespace Tests\Feature\Api;

use Tests\TestCase;
use JMac\Testing\Traits\AdditionalAssertions;

class MoviePlayControllerTest extends TestCase
{
    use AdditionalAssertions;

    /**
     * Base url for controllers
     * @var string
     */
    private string $baseUrl = '/api/movies';

    public function testMiddleware()
    {
        $this->assertRouteUsesMiddleware(
            'movies.plays',
            ['api']
        );
    }

    public function testGetPlayTimesForMovie()
    {
        $response = $this->get($this->baseUrl . '/' . 1 . '/plays');

        $response->assertSuccessful();
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "success",
            "data" => [
                '*' => [
                    "id",
                    "text"
                ]
            ],
            "message"
        ]);
    }
}
