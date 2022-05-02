<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use JMac\Testing\Traits\AdditionalAssertions;

class CinemaControllerTest extends TestCase
{
    use AdditionalAssertions;

    /**
     * Test middleware for controllers
     */
    public function testMiddleware()
    {
        $this->assertRouteUsesMiddleware(
            'movie-plays',
            ['api']
        );
    }

    public function index()
    {
        $response = $this->get('/api/movie-plays');

        //Test response success
        $response->assertSuccessful();
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'movies' => [
                        '*' => [
                            'id',
                            'movie_name',
                            'plays' => [
                                '*' => [
                                    'id',
                                    'theater_id',
                                    'start_time',
                                    'end_time'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'message'
        ]);
    }
}
