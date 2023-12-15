<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //para hacer testing, osea los datos de prueba con faker
            'titulo' => $this->faker->sentence(5),
            'descripcion' =>  $this->faker->sentence(20),
            'imagen' => $this->faker->uuid . '.jpg', //que no se corte el uuid y que añada la extension del archivo
            'user_id' => $this ->faker->randomElement([1,2,3,4])
        ];
    }
}
