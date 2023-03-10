<?php

namespace App\Http\Constants;

class LoanStatus
{
    const NOT_PAID = 1;
    const PAID = 2;
    const OVER = 3;

    public static function labels(): array
    {
        return [
            self::NOT_PAID => 'Belum Dibayar',
            self::PAID => 'Lunas',
            self::OVER => 'Belum dibayar, Melebihi Batas Waktu',
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
            
            default:
                # code...
                break;
        }
    }

}
