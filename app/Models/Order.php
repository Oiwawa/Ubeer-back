<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kblais\Uuid\Uuid;

class Order extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    const STATUS_ORDERED = 'ordered';
    const STATUS_DELIVERING = 'delivering';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELED = 'canceled';
    const STATUS_REFUSED = 'refused';

    protected $fillable = [
        'user_id',
        'seller_id',
        'order_list',
        'status',
        'deliver_time',
    ];

    protected $dates = [
        'deliver_time',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orders_items', 'order_id', 'product_id')
            ->withPivot('quantity')
            ->withTimestamps();
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
