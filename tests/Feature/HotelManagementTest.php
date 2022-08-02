<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Hotel;

class HotelManagementTest extends TestCase
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
        $response = $this->post(route('add_hotel'), [
            'name' => 'Inu eda jin',
            'email' => 'me@you.com'
        ]);

        $this->assertCount(1, Hotel::all());

        $response->assertRedirect(route('all_hotels'));
    }

    public function test_name_is_required_on_creation()
    {
        $response = $this->post(route('add_hotel'), [
            'name' => '',
            'email' => 'me@you.com'
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_email_is_required_on_creation()
    {
        $response = $this->post(route('add_hotel'), [
            'name' => 'Tijani',
            'email' => ''
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_email_is_a_valid_email_on_creation()
    {
        $response = $this->post(route('add_hotel'), [
            'name' => 'Tijani',
            'email' => 'm2@.com'
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_hotel_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->post(route('add_hotel'), [
            'name' => 'Inu eda jin',
            'email' => 'me@you.com'
        ]);

        $hotel = Hotel::first();
        $response = $this->patch(route('update_hotel', $hotel->id), [
            'name' => 'New name',
            'email' => 'new@you.com'
        ]);

        $hotel = $hotel->fresh(); //gets new updated data

        $this->assertEquals('New name', Hotel::first()->name);
        $this->assertEquals('new@you.com', Hotel::first()->email);

        $response->assertRedirect( route('show_hotel', $hotel->id));
    }


    public function test_hotel_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $this->post(route('add_hotel'), [
            'name' => 'Inu eda jin',
            'email' => 'me@you.com'
        ]);

        $hotel = Hotel::first();
        $response = $this->delete(route('delete_hotel', $hotel->id));

        $this->assertCount(0, Hotel::all());
        $response->assertRedirect(route('all_hotels'));
    }


}
