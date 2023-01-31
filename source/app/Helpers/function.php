<?php

use App\Enums\AdminRoleEnum;
use Illuminate\Support\Facades\Auth;

if (!function_exists('isSupperAdmin')) {
    function isSupperAdmin(): bool
    {
        return Auth::guard('admin')->user()->role === AdminRoleEnum::SUPER_ADMIN;
    }
}
