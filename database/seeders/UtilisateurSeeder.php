<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Utilisateur::create(
            [
                'nom' => 'Utilisateur',
                'email' => 'utilisateur@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'utilisateur'
            ]
        );

        Utilisateur::create(
            [
                'nom' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );

        Utilisateur::create(
            [
                'nom' => 'Support',
                'email' => 'support@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'support'
            ]
        );
    }
}