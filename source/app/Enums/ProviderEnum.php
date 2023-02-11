<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ProviderEnum extends Enum
{
    public const GITHUB = 1;
    public const GOOGLE = 2;

    public static function getKeyFromProviderEnum($provider)
    {
        return ProviderEnum::fromKey(strtoupper($provider))->value;
    }
}
