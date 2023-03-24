<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'title' => 'Event 1',
            'slug' => 'event-1',
            'description' => 'Event 1 description',
            'is_published' => true,
            'user_id' => 3
        ]);

        Event::create([
            'title' => 'Event 2',
            'slug' => 'event-2',
            'description' => 'Event 2 description',
            'is_published' => true,
            'user_id' => 3
        ]);
    }
}
