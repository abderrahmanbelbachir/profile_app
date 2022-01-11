<?php

namespace Tests\Unit;

use App\Models\Experience;
use App\Models\User;
use Tests\TestCase;

class ExperienceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_authenticated_user_can_update_experience()
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

    }

    public function test_not_authenticated_user_cannot_update_experience()
    {
        $user = User::factory()->create();

        $experiences = [
            Experience::factory()->create(),
            Experience::factory()->create()
        ];

        $request = [
            'experiences' => $experiences
        ];

        $response = $this->post('/experience', $request);


        $response->assertStatus(302);

    }

    public function test_create_multiple_experiences()
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

    public function test_create_one_experience()
    {
        $user = User::factory()->create();

        $experiences = [
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

    public function test_update_existed_experiences()
    {

        $fakeExperience = Experience::first();
        $user = User::findOrFail($fakeExperience->user_id);
        $experiences = [
            [
                'role' => $fakeExperience->role,
                'company' => $fakeExperience->company,
                'start_date' => $fakeExperience->start_date,
                'end_date' => $fakeExperience->end_date,
                'current_job' => false,
                'description' => $fakeExperience->description,
                'id' => $fakeExperience->id,
                'user_id' => $user->id
            ]
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
}
