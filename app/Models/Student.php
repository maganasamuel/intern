<?php

namespace App\Models;

use App\Enums\StudentStatus;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\{Builder, Model};

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $guarded = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    protected function casts(): array
    {
        return [
            'dob' => 'date',
            'scholarship_accredited' => 'boolean',
            'status' => StudentStatus::class,
        ];
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['first_name'] . ' ' . $attributes['middle_name'] . ' ' . $attributes['last_name']
        );
    }

    #[Scope]
    protected function filter(Builder $query, $filter = [])
    {
        $query->when(
            $filter['keyword'] ?? '',
            fn (Builder $query, $value) => $query->whereAny([
                'first_name',
                'middle_name',
                'last_name',
                'email',
                'contact_number',
            ], 'LIKE', "%{$value}%")
        )->when(
            ($filter['scholarship_accredited'] ?? '') == 'yes',
            fn (Builder $query) => $query->where('scholarship_accredited', 1)
        )->when(
            ($filter['scholarship_accredited'] ?? '') == 'no',
            fn (Builder $query) => $query->where('scholarship_accredited', 0)
        )->when(
            $filter['gender'] ?? '',
            fn (Builder $query, $value) => $query->where('gender', $value)
        )->when(
            $filter['course'] ?? '',
            fn (Builder $query, $value) => $query->where('course_id', $value)
        )->when(
            $filter['status'] ?? '',
            fn (Builder $query, $value) => $query->where('status', $value)
        );
    }
}
