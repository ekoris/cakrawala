<?php

namespace App\Http\Constants;

class TenorType
{
    const DAY = 1;
    const MONTH = 2;
    const YEAR = 3;

    public static function labels(): array
    {
        return [
            self::DAY => 'Hari',
            self::MONTH => 'Bulan',
            self::YEAR => 'Tahun',
        ];
    }

    public static function label(int $id)
    {   
        return static::labels()[$id];
    }

}
