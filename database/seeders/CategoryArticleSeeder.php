<?php

namespace Database\Seeders;

use App\Models\CategoryArticle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['technology', 'education', 'social', 'sports', 'health'];

        foreach ($categories as $value){
          CategoryArticle::create([
            "name" => $value
          ]);
        }
    }
}
