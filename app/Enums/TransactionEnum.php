<?php

namespace App\Enums;

enum TransactionEnum: string
{
    case STATUS_PENDING = 'pending';
    case STATUS_PROCESSING = 'processing';
    case STATUS_COMPLETE = 'complete';
    case STATUS_FAILED = 'failed';
    case STATUS_REFUND = 'refunded';
    case STATUS_REVERT = 'revert';

    case DIRECTION_CREDIT = 'credit';
    case DIRECTION_DEBIT = 'debit';

    case METHOD_WALLET = 'wallet';

    case TYPE_INTERNAL = 'internal';
    case TYPE_EXTERNAL = 'external';

    case VENDOR_LOCAL = 'local';
    case VENDOR_RAZORPAY = 'razorpay';
    case VENDOR_PHONEPE = 'phonepe';
    case VENDOR_NICEPE = 'nicepe';
}