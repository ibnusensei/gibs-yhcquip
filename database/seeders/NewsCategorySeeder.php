<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['school', 'academic', 'students', 'techno', 'public'];
        
        foreach ($categories as $value) {
            NewsCategory::create([
                "name" => $value
            ]);
        }
    }
}
