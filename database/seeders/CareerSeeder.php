<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Career;
use App\Models\Job;
use Faker\Factory as Faker;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $career = Career::create([
                'title' => $faker->jobTitle(),
                'description' => $faker->paragraph(),
                'date' => $faker->dateTimeThisYear(),
                'slug' => $faker->unique()->slug(),
                'is_published' => true,
            ]);
        
            $jobs = $faker->randomElements($array = [1, 2, 3, 4, 5, 6, 7], $count = $faker->numberBetween(3, 7));
            $career->jobs()->sync($jobs);
        
        }
        
    }
}
