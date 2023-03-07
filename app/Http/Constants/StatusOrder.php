<?php

namespace App\Http\Constants;

class StatusOrder
{
    const PENDING = 1;
    const WAITING_CONFIRMATION = 2;
    const APPROVED = 3;
    const CANCELED = 4;
    const SHIPPING = 5;
    const FINISH = 6;

    public static function labels(): array
    {
        return [
            self::PENDING => 'Pending',
            self::WAITING_CONFIRMATION => 'Menunggu Konfirmasi',
            self::APPROVED => 'Di Approve Dan Sedang di proses',
            self::CANCELED => 'Dibatalkan',
            self::SHIPPING => 'Dalam Pengiriman',
            self::FINISH => 'Selesai',
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
                return '<span class="badge badge-warning">'.static::labels()[$id].'</span>';
                break;
            case '3':
                return '<span class="badge badge-danger">'.static::labels()[$id].'</span>';
                break;
            case '4':
                return '<span class="badge badge-dark">'.static::labels()[$id].'</span>';
                break;
            case '5':
                return '<span class="badge badge-success">'.static::labels()[$id].'</span>';
                break;
            case '6':
                return '<span class="badge badge-warning">'.static::labels()[$id].'</span>';
                break;
            
            default:
                # code...
                break;
        }
    }


}
