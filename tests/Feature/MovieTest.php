<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */


    /** @test  */
    public function a_user_can_see_movie_search_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test  */
    public function a_user_can_search_movie()
    {
        $response = $this->get('/api/movie/search?q=new')
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [],
                    'metadata' => [
                        "current_page",
                        "per_page",
                        "page_count",
                        "total_count"
                    ],
                ]
            );
    }
}
