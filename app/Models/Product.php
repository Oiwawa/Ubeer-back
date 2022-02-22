<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kblais\Uuid\Uuid;

class Product extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'brewery_id',
    ];

    public function brewery()
    {
        return $this->belongsTo(Brewery::class)->withTrashed();
    }
}
