<?php

namespace App\Repositories\API;

use App\Models\AccountBank;
use App\Models\BannerPromo;
use App\Models\Collateral;
use App\Models\MailBox;
use App\Models\Market;

class MasterEloquent {

    public function market($params = [])
    {
        $query =  Market::latest();

        return $query->paginate(15);
    }

    public function bank($params = [])
    {
        $query =  AccountBank::latest();

        return $query->paginate(15);
    }

    public function collateral($params = [])
    {
        $query =  Collateral::latest();

        return $query->paginate(15);
    }

    public function bannerPromo($params = [])
    {
        $query =  BannerPromo::latest();

        return $query->paginate(15);
    }

    public function storeMailBox($data)
    {
        return MailBox::create([
            'user_id' => logged_in_user()->id,
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'value' => $data['value'] ?? null,
        ]);
    }
}