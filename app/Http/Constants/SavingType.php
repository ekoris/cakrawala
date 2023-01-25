<?php

namespace App\Http\Constants;

class SavingType
{
    const SIMBOK = 1;
    const PDH = 2;
    const SPM = 3;

    public static function labels(): array
    {
        return [
            self::SIMBOK => 'Simpanan Simbok',
            self::PDH => 'Simpanan PDH',
            self::SPM => 'Simpanan Penyertaan Modal',
        ];
    }

    public static function label(int $id)
    {   
        return static::labels()[$id];
    }

}
