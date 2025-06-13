<?php

namespace App\Enums;

enum Status: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case COMPLETE = 'complete';
    case FAILED = 'failed';
    case REFUND = 'refunded';
}