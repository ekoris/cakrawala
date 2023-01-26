<?php

namespace App\Http\Constants;

class LoanType
{
    const STARTUP_CAPITAL = 1;
    const KKB = 2;
    const UMROH = 3;

    public static function labels(): array
    {
        return [
            self::STARTUP_CAPITAL => 'Modal usaha',
            self::KKB => 'Kredit Kepemilikan Barang',
            self::UMROH => 'UMROH',
        ];
    }

    public static function label(int $id)
    {   
        return static::labels()[$id];
    }

}
