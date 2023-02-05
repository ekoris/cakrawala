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

    public static function labelHtml(int $id)
    {   

        switch ($id) {
            case '1':
                return '<span class="badge badge-secondary">'.static::labels()[$id].'</span>';
                break;
            case '2':
                return '<span class="badge badge-success">'.static::labels()[$id].'</span>';
                break;
            case '3':
                return '<span class="badge badge-danger">'.static::labels()[$id].'</span>';
                break;
            case '4':
                return '<span class="badge badge-dark">'.static::labels()[$id].'</span>';
                break;
            
            default:
                # code...
                break;
        }
    }

}
