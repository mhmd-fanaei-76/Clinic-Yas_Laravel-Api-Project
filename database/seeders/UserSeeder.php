<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->create([
            'full_name' => 'mohammad fanaei',
            'email' => 'mohammadfanaei031@gmail.com',
            'password' => '123',
            'section_id' => null
        ]);
        $user->assignRole(['admin','baseAdmin']);
    }
}
