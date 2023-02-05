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

    public static function labelHtml(int $id)
    {   

        switch ($id) {
            case '1':
                return '<span class="badge badge-secondary">'.static::labels()[$id].'</span>';
                break;
            case '2':
                return '<span class="badge badge-primary">'.static::labels()[$id].'</span>';
                break;
            case '3':
                return '<span class="badge badge-info">'.static::labels()[$id].'</span>';
                break;
            
            default:
                # code...
                break;
        }
    }

}
