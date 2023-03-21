<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\ProgramCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('program_categories')->truncate();
        $data = [
            'Pengembangan Kognitif', 'Pembentukan Karakter dan Perilaku', 'Pengembangan Minat Bakat & Keterampilan',
            'Pengembangan Guru (TS & TAS)', 'Peningkatan dan Pengembangan Layanan'
        ];

        foreach ($data as $d) {
            ProgramCategory::create([
                'slug' => str()->slug($d),
                'name' => $d,
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
