<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Career;
use carbon\Carbon;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $careers = [
            [
                'slug' => 'web-developer',
                'description' => 'We are looking for an experienced web developer to join our team.',
                'posisi' => 'Web Developer',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(30),
                'unit' => 'IT',
                'is_published' => true,
            ],
            [
                'slug' => 'graphic-designer',
                'description' => 'We are seeking a talented graphic designer to create stunning visual content.',
                'posisi' => 'Graphic Designer',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(30),
                'unit' => 'Marketing',
                'is_published' => true,
            ],
            [
                'slug' => 'sales-executive',
                'description' => 'We are looking for a motivated sales executive to join our growing team.',
                'posisi' => 'Sales Executive',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(30),
                'unit' => 'Sales',
                'is_published' => true,
            ],
        ];

        foreach ($careers as $career) {
            $career = Career::create($career);
            // You can also add media to the career model here if needed
        }
    }
    
}
