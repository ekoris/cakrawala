<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\AccountOfficerCollection;
use App\Http\Resources\BankCollection;
use App\Http\Resources\BannerPromoCollection;
use App\Http\Resources\CollateralCollection;
use App\Http\Resources\MarketCollection;
use App\Repositories\API\MasterEloquent;
use Illuminate\Http\Request;

class MasterController extends BaseController
{
   protected $master;

   public function __construct(MasterEloquent $master)
   {
      $this->master = $master;
   }
   
   public function market(Request $request)
   {
      return MarketCollection::collection($this->master->market($request->all()));
   }

   public function bank(Request $request)
   {
      return BankCollection::collection($this->master->bank($request->all()));
   }

   public function collateral(Request $request)
   {
      return CollateralCollection::collection($this->master->collateral($request->all()));
   }

   public function bannerPromo(Request $request)
   {
      return BannerPromoCollection::collection($this->master->bannerPromo($request->all()));
   }

   public function storeMailBox(Request $request)
   {
      $message = $this->master->storeMailBox($request->all());
      return $this->sendResponse($message, 'message send Success');
   }

   public function accountOfficer(Request $request)
   {
      return AccountOfficerCollection::collection($this->master->accountOfficer($request->all()));
   }
}