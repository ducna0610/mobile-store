<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class StatusOrderEnum extends Enum
{
    public const SPENDING = 0;
    public const DELIVERING = 1;
    public const DONE = 2;
    public const CANCEL = 3;

    public static function getArrayView()
    {
        return [
            self::SPENDING => 'Chờ duyệt',
            self::DELIVERING => 'Đang vận chuyển',
            self::DONE => 'Đã giao',
            self::CANCEL => 'Đã hủy',
        ];
    }

    public static function getStatusName($key)
    {
        $arr = StatusOrderEnum::getArrayView();

        return $arr[$key];
    }
}
