<?php

namespace App\Http\Constants;

class PaymentType
{
    const TRANSFER = 1;
    const CREDIT = 2;

    public static function labels(): array
    {
        return [
            self::TRANSFER => 'Transfer',
            self::CREDIT => 'Kredit',
        ];
    }

    public static function label(int $id)
    {   
        return static::labels()[$id];
    }

}
