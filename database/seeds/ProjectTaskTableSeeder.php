<?php

use Illuminate\Database\Seeder;

class ProjectTaskTableSeeder extends Seeder
{
    public function run()
    {
        \CodeProject\Entities\ProjectTask::truncate();
        factory(\CodeProject\Entities\ProjectTask::class, 10)->create();
    }
}
