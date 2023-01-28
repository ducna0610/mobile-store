<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'color',
        'disk',
        'ram',
        'chip',
        'pin',
        'quantity',
        'price',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function bills()
    {
        return $this->belongsToMany(Bill::class, 'bill_detail')->withPivot('price', 'quantity')->withTimestamps();
    }
}
