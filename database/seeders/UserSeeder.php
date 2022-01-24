<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::factory(1)
            ->hasProjects(3)
            ->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
            ]);

        User::factory(10)->hasProjects(3)->create();
    }
}
