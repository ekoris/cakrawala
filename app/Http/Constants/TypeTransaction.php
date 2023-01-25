<?php

namespace App\Http\Constants;

class TypeTransaction
{
    const IN = 1;
    const OUT = 2;

    public static function labels(): array
    {
        return [
            self::IN => 'IN',
            self::OUT => 'OUT',
        ];
    }

    public static function label(int $id)
    {   
        return static::labels()[$id];
    }

}
