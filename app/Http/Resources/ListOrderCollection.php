<?php
 
namespace App\Http\Resources;

use App\Http\Constants\PaymentType;
use App\Http\Constants\StatusOrder;
use Illuminate\Http\Resources\Json\JsonResource;
 
class ListOrderCollection extends JsonResource
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
            'order_id' => $this->id,
            'user_name' => optional($this->user)->name,
            'product_name' => optional($this->product)->name,
            'product_id' => optional($this->product)->id,
            'qty' => $this->qty,
            'total_order' => $this->total_order,
            'payment_label' => PaymentType::label($this->payment_type),
            'status_label' => StatusOrder::label($this->status),
            'validate_by' => optional($this->validate)->name,
            'finish_order_date' => $this->finish_order_date,
            'account_bank_id' => optional($this->accountBank)->id, 
            'account_bank_name' => optional($this->accountBank)->name, 
            'order_date' => date('Y-m-d H:i:s', strtotime($this->created_at)), 
        ];
    }
}