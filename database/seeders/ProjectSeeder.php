<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'name' => 'Project 1',
            'description' => 'Project description bla bla bla',
            'startDate' => '27-02-2021',
            'duration' => '083000'
        ]);

        Project::create([
            'name' => 'Project 2',
            'description' => 'Project description bla bla bla bla',
            'startDate' => '27-02-2021',
            'duration' => '023000'
        ]);
    }
}
