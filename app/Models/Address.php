<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kblais\Uuid\Uuid;

class Address extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'address',
        'zipcode',
        'city',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function brewery()
    {
        return $this->hasOne(Brewery::class);
    }
}
