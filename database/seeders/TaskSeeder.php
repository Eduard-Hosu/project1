<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'name' => 'Task 1',
            'user_id' => '2',
            'project_id' => '2',
            'description' => 'you have to bla bla bla',
            'status' => 'toDo'
        ]);

        Task::create([
            'name' => 'Task 2',
            'user_id' => '2',
            'project_id' => '2',
            'description' => 'you have to bla bla bla',
            'status' => 'toDo'
        ]);
    }
}
