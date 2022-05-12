<?php

namespace App\Crawler\Enum;

use BenSampo\Enum\Enum;

final class SeoKeywordStatus extends Enum
{
    public const INIT = 0;
    public const HAS_SEO_KEYWORD = 1;
    public const SEO_KEYWORD_ERROR = -1;
    public const SEO_KEYWORD_NO_DATA = -2;
}
