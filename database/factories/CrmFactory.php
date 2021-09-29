<?php

namespace Database\Factories;

use App\Models\Crm;
use Illuminate\Database\Eloquent\Factories\Factory;

class CrmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Crm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('ja_JP');

        return [
            'name' => $faker->name(),
            'email' => $this->faker->email(),
            'zipcode' => $this->faker->postcode(),
            'address' => $faker->prefecture() . $faker->city() . $faker->streetAddress(),
            'phone_number' => $this->faker->phoneNumber(),
        ];
    }
}
