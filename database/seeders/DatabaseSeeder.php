<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
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
        $admin = Admin::factory()->create([
            'name' => 'Admin',
            'last_name' => 'Montenegro',
            'first_name' => 'Zoe',
            'middle_name' => 'Joe',
            'email' => 'admin@gmail.com',
        ]);
    }
}
