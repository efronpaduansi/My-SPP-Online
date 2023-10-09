<?php

namespace Database\Seeders;

use App\Models\LevelSiswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LevelSiswa::create([
            'level_name' => 'TK',
            'start_nominal' => 100000
        ]);

        LevelSiswa::create([
            'level_name' => 'SD KLS I',
            'start_nominal' => 150000
        ]);

        LevelSiswa::create([
            'level_name' => 'SD KLS II',
            'start_nominal' => 200000
        ]);

        LevelSiswa::create([
            'level_name' => 'SD KLS III',
            'start_nominal' => 250000
        ]);

        LevelSiswa::create([
            'level_name' => 'SD KLS IV-VI',
            'start_nominal' => 300000
        ]);
    }
}
