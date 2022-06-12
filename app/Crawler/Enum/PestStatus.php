<?php

namespace App\Crawler\Enum;

use BenSampo\Enum\Enum;

final class PestStatus extends Enum
{
    public const INIT = 0;
    public const DO_NOT_LINK_PEST = -1;
    public const DO_NOT_GET_HTML = -2;
    public const SUCCESS = 1;
    public const FAIL_GET_PDF = -3;
    public const TYPE_NOT_SUPPORT = -4;
}
