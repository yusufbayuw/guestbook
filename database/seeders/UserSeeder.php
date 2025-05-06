<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate([
            'email' => 'demo@demo.com',
        ],[
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('cobacoba'),
        ]);

        $admin->assignRole('super_admin');
    }
}
