<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Driver::create([
            'name' => 'Driver',
            'email' => 'driver@gmail.com',
            'phone' => '089786756123',
            'password' => Hash::make('password')
        ]);

        Driver::factory()->count(6)->create();
    }
}
