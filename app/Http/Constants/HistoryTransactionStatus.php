<?php

namespace App\Http\Constants;

class HistoryTransactionStatus
{
    const PENDING = 1;
    const APPROVED = 2;
    const CANCELED = 3;

    public static function labels(): array
    {
        return [
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::CANCELED => 'Dibatalkan',
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
