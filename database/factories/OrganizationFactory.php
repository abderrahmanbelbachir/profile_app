<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        return [
            'organization' => $this->faker->name(),
            'associated_as' => $this->faker->name(),
            'start_date' => \DateTime::createFromFormat('Y-m-d', '2020-09-25'),
            'end_date' => \DateTime::createFromFormat('Y-m-d', '2021-01-01'),
            'current_job' => false,
            'description' => $this->faker->text(150),
            'user_id' => $user->id
        ];
    }
}
