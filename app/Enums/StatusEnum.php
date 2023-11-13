<?php

namespace App\Enums;

enum StatusEnum: string
{
    case PENDING = 'pending';
    case ASSIGNED = 'assigned';
    case IN_REVIEW = 'in_review';
    case SUCCESS = 'success';

    public static function values(): array
    {
        return array_map(fn(StatusEnum $status) => $status->value, self::cases());
    }
}
