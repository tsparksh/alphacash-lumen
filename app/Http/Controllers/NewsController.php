<?php

namespace App\Http\Controllers;

use App\Enums\News\NewsThemeEnum;
use App\Models\News;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NewsController extends Controller
{
    public function getAll()
    {
        return QueryBuilder::for(News::class)
            ->allowedSorts(['id', 'published_at', 'theme'])
            ->allowedFilters([
                'theme',
                AllowedFilter::scope('published_between'),
            ])
            ->paginate();
    }
}
