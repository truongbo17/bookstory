<?php

namespace App\Crawler\Enum;

use BenSampo\Enum\Enum;

final class UrlStatus extends Enum
{
    public const INIT = 0;
    public const RUNNING = 1;
    public const FAIL = -1;
}
