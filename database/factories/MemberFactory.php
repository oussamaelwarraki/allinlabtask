<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Member;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
            'remember_token' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'phone' => $this->faker->phoneNumber,
            'birthdate' => $this->faker->date(),
            'address' => $this->faker->word,
            'city' => $this->faker->city,
            'state' => $this->faker->word,
            'zip_code' => $this->faker->word,
            'country' => $this->faker->country,
            'status' => $this->faker->randomElement(["active","inactive"]),
            'membership_start_date' => $this->faker->date(),
            'membership_end_date' => $this->faker->date(),
        ];
    }
}
