<?php

namespace App\Http\Constants;

class HistoryTransactionStatus
{
    const PENDING = 1;
    const APPROVED = 2;
    const CANCELED = 2;

    public static function labels(): array
    {
        return [
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::CANCELED => 'Dibatalkan',
        ];
    }

    public static function label(int $id)
    {   
        return static::labels()[$id];
    }

}
