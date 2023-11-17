<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['php', 'laravel', 'programming', 'css', 'js', 'debugging', 'mysql', 'db', 'vue', 'vite', 'html', 'bootstrap'];

        foreach ($technologies as $technology) {
            $new_technology = new Technology();
            $new_technology->name_tech = $technology;
            $new_technology->save();
        }
    }
}
