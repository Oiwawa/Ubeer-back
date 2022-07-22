<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'seller' => $this->whenLoaded('seller', function () {
                return new SellerResource($this->seller);
            }, $this->seller_id),
            'price' => $this->price,
            'abv' => $this->abv,
            'icon' => $this->icon,
        ];
    }
}
