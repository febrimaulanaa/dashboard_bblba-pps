<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
            'name' => 'Administrator',
            'username' => 'febri',
            'password' => \Illuminate\Support\Facades\Hash::make('sisio123'),
            'role' => 'superadmin',
        ]);
    }
}
