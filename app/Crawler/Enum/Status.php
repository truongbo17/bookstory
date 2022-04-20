<?php

namespace App\Crawler\Enum;

use BenSampo\Enum\Enum;

final class Status extends Enum
{
    public const PENDING = 0;
    public const ACTIVE = 1;
    public const DELETED = -1;
}

