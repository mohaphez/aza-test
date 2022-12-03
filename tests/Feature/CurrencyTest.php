<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CurrencyTest extends TestCase
{

    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test  */
    public function a_user_can_see_email_currency_page()
    {

        User::factory(20)->create();

        $response = $this->get('/price');
        $response->assertSeeText('Currency Price')
            ->assertStatus(200);
    }
}
