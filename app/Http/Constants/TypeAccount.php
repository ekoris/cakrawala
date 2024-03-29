<?php

namespace App\Http\Constants;

class TypeAccount
{
    const SAVING = 1;
    const LOAN = 2;

    public static function labels(): array
    {
        return [
            self::SAVING => 'Simpanan',
            self::LOAN => 'Pinjaman',
        ];
    }

    public static function label($id = '')
    {   
        if ($id == '') {
            return null;
        }

        return static::labels()[$id];
    }

}
