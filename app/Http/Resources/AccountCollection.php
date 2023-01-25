<?php
 
namespace App\Http\Resources;

use App\Http\Constants\PaymentType;
use App\Http\Constants\StatusOrder;
use App\Http\Constants\TypeAccount;
use Illuminate\Http\Resources\Json\JsonResource;
 
class AccountCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'name' => $this->name,
            'date_of_birth' => $this->date_of_birth,
            'place_of_birth' => $this->place_of_birth,
            'nik' => $this->nik,
            'address' => $this->address,
            'account_officer' => $this->account_officer,
            'market_id' => $this->market_id,
            'market_name' => optional($this->market)->name,
            'identity_attachment_url' => $this->url_identity_attachment,
            'self_photo_url' => $this->url_self_photo,
            'signature_photo_url' => $this->url_signature,
            'status' => $this->status,
            'type_account' => $this->type_account,
            'type_account_label' => TypeAccount::label($this->type_account),
        ];
    }
}