<?php

namespace App\Enums;

enum ReviewStatusEnum: string
{
    case PENDING = 'pending';
    case ASSIGNED = 'assigned';
    case IN_REVIEW = 'in_review';
    case SUCCESS = 'success';
}
