<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('levels')->truncate();
        $data = [
            'SMP', 'SMA'
        ];

        foreach ($data as $d) {
            Level::create([
                'slug' => str()->slug($d),
                'name' => $d,
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
