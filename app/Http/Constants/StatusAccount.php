<?php

namespace App\Http\Constants;

class StatusAccount
{
    const PENDING = 1;
    const APPROVED = 2;

    public static function labels(): array
    {
        return [
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
        ];
    }

    public static function label(int $id)
    {   
        return static::labels()[$id];
    }

}
