<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['id' => 1, 'name' => 'Human Resources', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Finance', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Executive', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
