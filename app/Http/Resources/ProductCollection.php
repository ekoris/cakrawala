<?php
 
namespace App\Http\Resources;
 
use Illuminate\Http\Resources\Json\JsonResource;
 
class ProductCollection extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'category_name' => optional($this->productCategory)->name,
            'photos' => $this->productPhotos->map(function ($product)  {
                return [
                    'is_thumbnail' => $product->is_thumbnail,
                    'url' => $product->url_photo
                ];
            }),
        ];
    }
}