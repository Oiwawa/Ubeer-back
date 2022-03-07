<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kblais\Uuid\Uuid;

class Order extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $fillable = [
        'user_id',
        'brewery_id',
        'order_list',
        'status',
        'ordered_for',
    ];

    protected $dates = [
        'ordered_for',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brewery()
    {
        return $this->belongsTo(Brewery::class);
    }

    public function getOrderListAttribute()
    {
        $totalPrice = $this->getTotalPriceAttribute();

    }

    public function setOrderListAttribute($data)
    {

    }

    public function getTotalPriceAttribute()
    {
        $totalPrice = 0;
        foreach ($this->orderList as $item){
            $totalPrice+= $item->price;
        }
        return $totalPrice;
    }


}
