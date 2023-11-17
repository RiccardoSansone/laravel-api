<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;



class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i=0; $i < 10; $i++) { 
            
            $project = new Project();
            $project->thumb = 'placeholders/' . $faker->image('public/storage/placeholders', category: 'Project', fullPath: false);
            $project->projectlink = $faker->realText(15);
            $project->githublink = $faker->url();
            $project->title = $faker->realText(10);
            $project->description = $faker->realText(50);
            $project->authors = $faker->name();
            $project->slug = Str::slug($project->title, '-');
            $project->save();

        }
    }
}
