<?php

use Illuminate\Database\Seeder;

class ProjectMembersTableSeeder extends Seeder
{
    public function run()
    {
        \CodeProject\Entities\ProjectMembers::truncate();
        factory(\CodeProject\Entities\ProjectMembers::class, 10)->create();
    }
}
