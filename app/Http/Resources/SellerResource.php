<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
{

    public function toArray($request)
    {
        return collect(parent::toArray($request))->except([
            'password',
            'created_at',
            'updated_at',
            'deleted_at',
        ])->toArray();
    }
}
