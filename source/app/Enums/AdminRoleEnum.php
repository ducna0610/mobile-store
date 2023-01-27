<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AdminRoleEnum extends Enum
{
    public const ADMIN = 0;
    public const SUPER_ADMIN = 1;

    public static function getArrayView()
    {
        return [
            self::ADMIN => 'Nhân viên',
            self::SUPER_ADMIN => 'Quản lý',
        ];
    }

    public static function getStatusName($key)
    {
        $arr = AdminRoleEnum::getArrayView();

        return $arr[$key];
    }
}
