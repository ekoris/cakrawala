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
