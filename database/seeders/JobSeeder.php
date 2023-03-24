<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use Carbon\Carbon;
use Faker\Factory as FakerFactory;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 10; $i++) {
            $job = Job::create([
                'slug' => $faker->slug(),
                'description' => $faker->sentence(10),
                'posisi' => $faker->jobTitle(),
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(30),
                'unit' => $faker->randomElement(['IT', 'Marketing', 'Sales']),
                'is_published' => true,
            ]);
    }
}
    
}
