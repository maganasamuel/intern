<?php

namespace Database\Seeders;

use App\Models\{Course, Student};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $query = Student::whereDate('created_at', '2026-07-09')->where('scholarship_accredited', 1)
            ->orWhere(function (Builder $query) {
                $query->where('first_name', 'alice')
                    ->orWhere('last_name', 'alpha');
            });

        echo $query->toRawSql();

        return;
        Course::truncate();
        Student::truncate();

        Student::factory()->count(100)->create();
    }
}
