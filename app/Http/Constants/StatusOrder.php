<?php

namespace App\Http\Constants;

class StatusOrder
{
    const PENDING = 1;
    const WAITING_CONFIRMATION = 2;
    const APPROVED = 3;
    const SHIPPING = 4;
    const FINISH = 5;

    public static function labels(): array
    {
        return [
            self::PENDING => 'Pending',
            self::WAITING_CONFIRMATION => 'Menunggu Konfirmasi',
            self::APPROVED => 'Diterima',
            self::SHIPPING => 'Dalam Pengiriman',
            self::FINISH => 'Selesai',
        ];
    }

    public static function label(int $id)
    {   
        return static::labels()[$id];
    }

}
