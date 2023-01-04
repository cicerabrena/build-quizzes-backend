<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $userId = User::first()->id;

        $types = [
            'radio',
            'checkbox',
            'text',
            'textarea',
            'image'
        ];

        foreach ($types as $type) {
            Type::factory()->create([
                'name' => $type,
                'user_id' => $userId
            ]);
        }

    }
}
