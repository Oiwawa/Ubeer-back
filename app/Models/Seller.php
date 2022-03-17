<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kblais\Uuid\Uuid;

class Seller extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'address',
        'zipcode',
        'city',
    ];

    public function products()
    {
        return $this->hasMany(Product::class)->withTrashed();
    }
}
