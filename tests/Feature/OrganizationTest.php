<?php

namespace Tests\Feature;

use App\Models\Experience;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_update_organization()
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

    public function test_update_organization_null_organization()
    {
        $user = User::factory()->create();

        $fakeOrganization = Organization::factory()->create();
        $organizations = [
            [
                'associated_as' => $fakeOrganization->associated_as,
                'start_date' => $fakeOrganization->start_date,
                'end_date' => $fakeOrganization->end_date,
                'current_job' => false,
                'description' => $fakeOrganization->description,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'organizations' => $organizations
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/organization', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

    public function test_update_organization_null_associated_as()
    {
        $user = User::factory()->create();

        $fakeOrganization = Organization::factory()->create();
        $organizations = [
            [
                'organization' => $fakeOrganization->organization,
                'start_date' => $fakeOrganization->start_date,
                'end_date' => $fakeOrganization->end_date,
                'current_job' => false,
                'description' => $fakeOrganization->description,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'organizations' => $organizations
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/organization', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

    public function test_update_organization_null_start_date()
    {
        $user = User::factory()->create();

        $fakeOrganization = Organization::factory()->create();
        $organizations = [
            [
                'organization' => $fakeOrganization->organization,
                'associated_as' => $fakeOrganization->associated_as,
                'end_date' => $fakeOrganization->end_date,
                'current_job' => false,
                'description' => $fakeOrganization->description,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'organizations' => $organizations
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/organization', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

    public function test_update_organization_null_end_date()
    {
        $user = User::factory()->create();

        $fakeOrganization = Organization::factory()->create();
        $organizations = [
            [
                'organization' => $fakeOrganization->organization,
                'associated_as' => $fakeOrganization->associated_as,
                'start_date' => $fakeOrganization->start_date,
                'current_job' => false,
                'description' => $fakeOrganization->description,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'organizations' => $organizations
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/organization', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

    public function test_update_organization_null_current_job()
    {
        $user = User::factory()->create();

        $fakeOrganization = Organization::factory()->create();
        $organizations = [
            [
                'organization' => $fakeOrganization->organization,
                'associated_as' => $fakeOrganization->associated_as,
                'start_date' => $fakeOrganization->start_date,
                'end_date' => $fakeOrganization->end_date,
                'description' => $fakeOrganization->description,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'organizations' => $organizations
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/organization', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

    public function test_update_organization_null_description()
    {
        $user = User::factory()->create();

        $fakeOrganization = Organization::factory()->create();
        $organizations = [
            [
                'organization' => $fakeOrganization->organization,
                'associated_as' => $fakeOrganization->associated_as,
                'start_date' => $fakeOrganization->start_date,
                'end_date' => $fakeOrganization->end_date,
                'current_job' => $fakeOrganization->current_job,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'organizations' => $organizations
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/organization', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

    public function test_update_organization_description_size()
    {
        $user = User::factory()->create();

        $fakeOrganization = Organization::factory()->create();
        $organizations = [
            [
                'organization' => $fakeOrganization->organization,
                'associated_as' => $fakeOrganization->associated_as,
                'start_date' => $fakeOrganization->start_date,
                'end_date' => $fakeOrganization->end_date,
                'current_job' => $fakeOrganization->current_job,
                'description' => $fakeOrganization->description . ' ' . $fakeOrganization->description . ' ' . $fakeOrganization->description,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'organizations' => $organizations
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/organization', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

}
