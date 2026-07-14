<?php

namespace App\Enums;

enum StudentStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Suspended = 'suspended';
    case Expelled = 'expelled';
    case Graduated = 'graduated';
    case OnLeave = 'on_leave';

    public function label()
    {
        return str($this->value)->replace('_', ' ')->title()->value;
    }

    public function color()
    {
        return match ($this) {
            self::Active => 'text-bg-primary',
            self::Inactive => 'text-bg-secondary',
            self::Suspended => 'text-bg-warning',
            self::Expelled => 'text-bg-danger',
            self::Graduated => 'text-bg-success',
            self::OnLeave => 'text-bg-info',
        };
    }

    public static function list(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($item) => [$item->value => $item->label()])
            ->all();
    }
}
