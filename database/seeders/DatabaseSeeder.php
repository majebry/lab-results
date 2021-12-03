<?php

namespace Database\Seeders;

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
        \App\Models\User::create([
            'name' => 'Roumieh',
            'email' => 'roumieh@premiermedicine.com',
            'password' => bcrypt('sw3etClub16')
        ]);
    }
}
