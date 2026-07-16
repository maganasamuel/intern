<?php

namespace Database\Seeders;

use App\Models\{Course, Student};
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::truncate();
        Student::truncate();

        Student::factory()->count(100)->create();
    }
}
