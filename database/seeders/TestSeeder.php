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
        collect([1, 2, 3, 4])->chunk(2)->each(function ($chunks) {
            echo "\n";

            $chunks->each(function ($chunk) {
                echo $chunk . "\n";
            });
        });

        return;

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
