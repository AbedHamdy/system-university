<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SuperAdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => env("SUPER_ADMIN_NAME"),
            "email" => env("SUPER_ADMIN_ACCOUNT"),
            "password" =>  Hash::make(env("SUPER_ADMIN_PASSWORD")),
        ];
    }
}
