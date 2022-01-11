<?php

namespace Tests\Feature;

use App\Models\Experience;
use App\Models\Organization;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateDetailsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_details()
    {
        $user = User::factory()->create();

        $request = [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/profile', $request);


        $response->assertRedirect(route('dashboard'));

        // $response->assertStatus(200);
    }

}
