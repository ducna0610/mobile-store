<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'provider',
        'email',
        'gender',
        'password',
        'dob',
        'phone',
        'address',
        'token',
    ];

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'rates')->withPivot('star', 'comment')->withTimestamps();
    }
}
