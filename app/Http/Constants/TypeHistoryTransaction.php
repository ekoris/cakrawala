<?php

namespace App\Http\Constants;

class TypeHistoryTransaction
{
    const IN = 1;
    const OUT = 2;

    public static function labels(): array
    {
        return [
            self::IN => 'In',
            self::OUT => 'Out',
        ];
    }

    public static function label(int $id)
    {   
        return static::labels()[$id];
    }

}
