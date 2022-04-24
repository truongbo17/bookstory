<?php

namespace App\Crawler\Enum;

use BenSampo\Enum\Enum;

final class UserStatus extends Enum
{
    public const ACTIVE = 1;
    public const DEACTIVE = -1;
    public const DELETE = -2;
}
