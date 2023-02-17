<?php

namespace App\Models;

use App\Enums\AdminRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    // public $timestamps = false;

    // ===========================
    protected $fillable = [
        'name',
        'email',
        'gender',
        'phone',
        'address',
        'password',
    ];

    public function getRoleNameAttribute()
    {
        return AdminRoleEnum::getKeys($this->role)[0];
    }

    public function getGenderNameAttribute()
    {
        return ($this->gender == 1) ? 'Nam' : 'Nữ';
    }

    public function bills()
    {
        return $this->belongsToMany(Bill::class, 'order_confirm')->withPivot('status')->withTimestamps();
    }
}
