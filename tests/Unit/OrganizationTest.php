<?php

namespace Tests\Unit;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class OrganizationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_authenticated_user_can_update_organization()
    {
        $user = User::factory()->create();

        $organizations = [
            Organization::factory()->create(),
            Organization::factory()->create()
        ];

        $request = [
            'organizations' => $organizations
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/organization', $request);


        $response->assertRedirect(route('dashboard'));

    }

    public function test_not_authenticated_user_cannot_update_organization()
    {
        $user = User::factory()->create();

        $organizations = [
            Organization::factory()->create(),
            Organization::factory()->create()
        ];

        $request = [
            'organizations' => $organizations
        ];

        $response = $this->post('/organization', $request);


        $response->assertStatus(302);

    }

    public function test_create_multiple_organizations()
    {
        $user = User::factory()->create();

        $organizations = [
            Organization::factory()->create(),
            Organization::factory()->create()
        ];

        $request = [
            'organizations' => $organizations
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/organization', $request);


        $response->assertRedirect(route('dashboard'));

        // $response->assertStatus(200);
    }

    public function test_create_one_organization()
    {
        $user = User::factory()->create();

        $organizations = [
            Organization::factory()->create()
        ];

        $request = [
            'organizations' => $organizations
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/organization', $request);


        $response->assertRedirect(route('dashboard'));

        // $response->assertStatus(200);
    }

    public function test_update_existed_organizations()
    {

        $fakeOrganization = Organization::first();
        $user = User::findOrFail($fakeOrganization->user_id);
        $organizations = [
            [
                'associated_as' => $fakeOrganization->associated_as,
                'organization' => $fakeOrganization->organization,
                'start_date' => $fakeOrganization->start_date,
                'end_date' => $fakeOrganization->end_date,
                'current_job' => false,
                'description' => $fakeOrganization->description,
                'id' => $fakeOrganization->id,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'organizations' => $organizations
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/organization', $request);

        $response->assertRedirect(route('dashboard'));

        // $response->assertStatus(200);
    }
}
