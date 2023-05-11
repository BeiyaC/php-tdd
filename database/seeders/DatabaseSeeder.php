<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)
            ->hasProjects(3, function (array $attributes, User $user) {
        return ['user_id' => $user->id];
    })
            ->create();
    }
}
