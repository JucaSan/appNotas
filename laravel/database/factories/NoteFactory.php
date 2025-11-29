<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $types = ['normal', 'important', 'reminder'];
        $type = $this->faker->randomElement($types);

        $isImportant = $type === 'important';

        return [
            'title' => $this->faker->sentence(),
            'content' =>$this->faker->paragraph(),
            'user_id' => 1,
            'type' => $type,
            'is_important' => $isImportant,
            'reminder_date' => $type === 'reminder'
                    ? $this->faker->dateTimeBetween('now', '+7 days')
                    : null,
            'metadata' => null,
        ];
    }
}
