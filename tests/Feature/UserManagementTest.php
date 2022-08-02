<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_account_creation()
    {
        $this->withoutExceptionHandling();
        $response = $this->post(route('add_users'), [
            'name' => 'Mustapha Tijani',
            'email' => 'thenewxpat@gmail.com',
            'password' => 'password',
            'dob' => '09/08/2019',
        ]);

        $this->assertCount(1, User::all());
        $this->assertInstanceOf(Carbon::class, User::first()->dob);
        $response->assertRedirect(route('all_users'));
    }
}
