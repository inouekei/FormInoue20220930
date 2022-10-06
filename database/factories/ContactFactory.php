<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fullname' => $this->faker->name,
            'gender' => $this->faker->numberBetween(1, 2),
            'email' => $this->faker->safeEmail,
            'postcode' => $this->faker->postcode1 . '-' . $this->faker->postcode2,
            'address' => $this->faker->prefecture . $this->faker->streetAddress,
            'building_name' => $this->faker->secondaryAddress,
            'opinion' => $this->faker->realText($this->faker->numberBetween(20, 30)),
        ];
    }
}
