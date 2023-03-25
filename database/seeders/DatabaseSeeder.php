<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(CareerSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(ProgramCategorySeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(NewsCategorySeeder::class);
        $this->call(CategoryArticleSeeder::class);
    }
}
