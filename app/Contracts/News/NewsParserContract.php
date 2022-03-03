<?php

namespace App\Contracts\News;

use App\Enums\News\NewsThemeEnum;
use Illuminate\Support\Collection;

interface NewsParserContract
{
    public function parseNews(NewsThemeEnum $theme, string $sortBy = '', int $count = 1, int $page = 1): Collection;
}
