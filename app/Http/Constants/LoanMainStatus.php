<?php

namespace App\Http\Constants;

class LoanMainStatus
{
    const NEW = 1;
    const APPROVE = 2;
    const DONE = 3;
    const CANCELED = 4;

    public static function labels(): array
    {
        return [
            self::NEW => 'Pengajuan Baru',
            self::APPROVE => 'Di setujui',
            self::DONE => 'Selesai',
            self::CANCELED => 'Di Batalkan',
        ];
    }

    public static function label(int $id)
    {   
        return static::labels()[$id];
    }

}
