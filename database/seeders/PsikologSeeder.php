<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PsikologSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [ 'email' => 'psikolog@gmail.com' ],
            [
                'name' => 'Haikal Psikolog',
                'password' => Hash::make('psikolog123'),
                'role' => 'psikolog',
            ]
        );
    }
} 