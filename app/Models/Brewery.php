<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kblais\Uuid\Uuid;

class Brewery extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'address_id',
    ];


    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class)->withTrashed();
    }
}
