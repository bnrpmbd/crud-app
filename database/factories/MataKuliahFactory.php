<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MataKuliahFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'sks' => $this->faker->numberBetween(2, 4),
// PENTING: jangan set 'dosen_id' supaya tidak membuat dosen baru otomatis 
        ];
    }
}
