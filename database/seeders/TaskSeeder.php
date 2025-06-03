<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory(20)->create([
            'status' => Status::PENDING,
            'user_id' => 1
        ]);

        Task::factory(20)->create([
            'status' => Status::COMPLETED,
            'user_id' => 1
        ]);
    }
}
