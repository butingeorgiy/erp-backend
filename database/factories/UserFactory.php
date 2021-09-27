<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape([
        'email' => "string",
        'password' => "string",
        'type_id' => "int",
        'status_id' => "int"
    ])]
    public function definition(): array
    {
        return [
            'email' => $this->faker->email(),
            'password' => User::hashPassword('12345678'),
            'type_id' => User::$PHYSICAL_RECRUITER_TYPE_ID,
            'status_id' => User::$NORMAL_STATUS_ID
        ];
    }
}
