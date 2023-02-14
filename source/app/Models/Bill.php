<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name_receiver',
        'phone_receiver',
        'address_receiver',
        'total_price',
        'note',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class, 'bill_detail')->withPivot('price', 'quantity')->withTimestamps();
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'order_confirm')->withPivot('status')->withTimestamps();
    }
}
