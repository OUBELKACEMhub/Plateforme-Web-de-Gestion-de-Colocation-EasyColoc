<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Nourriture'],
            ['name' => 'Loyer'],
            ['name' => 'Électricité & Eau'],
            ['name' => 'Internet'],
            ['name' => 'Ménage'],
            ['name' => 'Transport'],
            ['name' => 'Autres'],
        ];

        foreach ($categories as $category) {
            Categorie::create($category);
        }
    }
}