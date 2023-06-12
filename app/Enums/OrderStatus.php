<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self APPROVED()
 * @method static self REJECTED()
 * @method static self PENDING()
 */
class OrderStatus extends Enum
{
    protected static function values(): array
    {
        return [
            'APPROVED' => 'APPROVED',
            'REJECTED' => 'REJECTED',
            'PENDING' => 'PENDING',
        ];
    }
}
