<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nom' => 'Problèmes de connexion', 'description' => 'Problèmes liés à la connexion au réseau ou aux services.'],
            ['nom' => 'Bugs logiciels', 'description' => 'Erreurs ou dysfonctionnements dans les logiciels.'],
            ['nom' => 'Installation de logiciels', 'description' => 'Problèmes liés à l\'installation de logiciels.'],
            ['nom' => 'Problèmes matériels (ordinateur, imprimante, etc.)', 'description' => 'Problèmes liés au matériel informatique.'],
            ['nom' => 'Assistance réseau', 'description' => 'Problèmes liés au réseau ou à la connectivité.'],
        ];

        // Insérer chaque catégorie dans la base de données
        foreach ($categories as $category) {
            Categorie::create($category);
        }
    }
}
