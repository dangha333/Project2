<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UploadFile>
 */
class UploadFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_name' => $this->faker->lexify('file_????.txt'),
            'file_path' => $this->faker->filePath(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
