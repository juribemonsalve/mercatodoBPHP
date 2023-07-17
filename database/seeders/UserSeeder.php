<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'documentType' => 'CC',
            'document'=> '1037661112',
            'name' => 'Juan',
            'surname' => 'Uribe',
            'email' => 'admin@mercatodo.com',
            'email_verified_at' => now(),
            'mobile'=> '3045293688',
            'address'=> 'Avenida 43 #57-39',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status'=> 'active',
            'remember_token' => Str::random(10),
        ])->assignRole('Admin');

        User::create([
            'documentType' => 'CC',
            'document'=> '1020574620',
            'name' => 'Tatiana',
            'surname' => 'Uribe',
            'email' => 'tatiana@mercatodo.com',
            'email_verified_at' => now(),
            'mobile'=> '3218813319',
            'address'=> 'Avenida 43 #57-39',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status'=> 'active',
            'remember_token' => Str::random(10),
        ])->assignRole('Client');

        User::factory(5)->create()->each(
            function ($user) {
                $user->assignRole('Admin');
            }
        );
    }
}
