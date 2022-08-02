<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Hotel;

class HotelReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_hotel_creation()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/hotels', [
            'name' => 'Inu eda jin',
            'email' => 'me@you.com'
        ]);

        $response->assertOk();
        $this->assertCount(1, Hotel::all());
    }

    public function test_name_is_required_on_creation()
    {
        $response = $this->post('/hotels', [
            'name' => '',
            'email' => 'me@you.com'
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_email_is_required_on_creation()
    {
        $response = $this->post('/hotels', [
            'name' => 'Tijani',
            'email' => ''
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_email_is_a_valid_email_on_creation()
    {
        $response = $this->post('/hotels', [
            'name' => 'Tijani',
            'email' => 'm2@.com'
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_hotel_can_update()
    {
        $this->withoutExceptionHandling();
        $this->post('/hotels', [
            'name' => 'Inu eda jin',
            'email' => 'me@you.com'
        ]);

        $hotel = Hotel::first();
        $this->patch('/hotels/'. $hotel->id, [
            'name' => 'New name',
            'email' => 'new@you.com'
        ]);

        $this->assertEquals('New name', Hotel::first()->name);
        $this->assertEquals('new@you.com', Hotel::first()->email);
    }
}
