<?php

namespace Tests\Feature;

use App\Models\Experience;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExperienceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_update_experience()
    {
        $user = User::factory()->create();

        $experiences = [
            Experience::factory()->create(),
            Experience::factory()->create()
        ];

        $request = [
            'experiences' => $experiences
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/experience', $request);


        $response->assertRedirect(route('dashboard'));

        // $response->assertStatus(200);
    }

    public function test_update_experience_null_company()
    {
        $user = User::factory()->create();

        $fakeExperience = Experience::factory()->create();
        $experiences = [
            [
                'role' => $fakeExperience->role,
                'start_date' => $fakeExperience->start_date,
                'end_date' => $fakeExperience->end_date,
                'current_job' => false,
                'description' => $fakeExperience->description,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'experiences' => $experiences
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/experience', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

    public function test_update_experience_null_role()
    {
        $user = User::factory()->create();

        $fakeExperience = Experience::factory()->create();
        $experiences = [
            [
                'company' => $fakeExperience->company,
                'start_date' => $fakeExperience->start_date,
                'end_date' => $fakeExperience->end_date,
                'current_job' => false,
                'description' => $fakeExperience->description,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'experiences' => $experiences
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/experience', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

    public function test_update_experience_null_start_date()
    {
        $user = User::factory()->create();

        $fakeExperience = Experience::factory()->create();
        $experiences = [
            [
                'company' => $fakeExperience->company,
                'role' => $fakeExperience->role,
                'end_date' => $fakeExperience->end_date,
                'current_job' => false,
                'description' => $fakeExperience->description,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'experiences' => $experiences
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/experience', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

    public function test_update_experience_null_end_date()
    {
        $user = User::factory()->create();

        $fakeExperience = Experience::factory()->create();
        $experiences = [
            [
                'company' => $fakeExperience->company,
                'role' => $fakeExperience->role,
                'start_date' => $fakeExperience->start_date,
                'current_job' => false,
                'description' => $fakeExperience->description,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'experiences' => $experiences
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/experience', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

    public function test_update_experience_null_current_job()
    {
        $user = User::factory()->create();

        $fakeExperience = Experience::factory()->create();
        $experiences = [
            [
                'company' => $fakeExperience->company,
                'role' => $fakeExperience->role,
                'start_date' => $fakeExperience->start_date,
                'end_date' => $fakeExperience->end_date,
                'description' => $fakeExperience->description,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'experiences' => $experiences
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/experience', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

    public function test_update_experience_null_description()
    {
        $user = User::factory()->create();

        $fakeExperience = Experience::factory()->create();
        $experiences = [
            [
                'company' => $fakeExperience->company,
                'role' => $fakeExperience->role,
                'start_date' => $fakeExperience->start_date,
                'end_date' => $fakeExperience->end_date,
                'current_job' => $fakeExperience->current_job,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'experiences' => $experiences
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/experience', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

    public function test_update_experience_description_size()
    {
        $user = User::factory()->create();

        $fakeExperience = Experience::factory()->create();
        $experiences = [
            [
                'company' => $fakeExperience->company,
                'role' => $fakeExperience->role,
                'start_date' => $fakeExperience->start_date,
                'end_date' => $fakeExperience->end_date,
                'current_job' => $fakeExperience->current_job,
                'description' => $fakeExperience->description . ' ' . $fakeExperience->description . ' ' . $fakeExperience->description,
                'user_id' => $user->id
            ]
        ];

        $request = [
            'experiences' => $experiences
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/experience', $request);

        $response->assertStatus(302);

        // $response->assertStatus(200);
    }

}
