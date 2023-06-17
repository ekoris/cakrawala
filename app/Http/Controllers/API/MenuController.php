<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\AccountCollection;
use App\Repositories\API\SettingEloquent;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    protected $setting;

    public function __construct(SettingEloquent $setting)
    {
        $this->setting = $setting;
    }

    public function pageSaving(Request $request)
    {
        $message = $this->setting->pageSaving();
        return $this->sendResponse($message, 'message send Success');
    }

    public function pageLoan(Request $request)
    {
        $message = $this->setting->pageLoan();
        return $this->sendResponse($message, 'message send Success');
    }

}