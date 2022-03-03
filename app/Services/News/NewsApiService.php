<?php

namespace App\Services\News;

use App\Contracts\News\NewsParserContract;
use App\Enums\News\NewsThemeEnum;
use App\Exceptions\NewsApiCallException;
use App\Models\News;
use App\Models\Source;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class NewsApiService implements NewsParserContract
{
    public function parseNews(NewsThemeEnum $theme, string $sortBy = 'publishedAt', int $count = 1, int $page = 1): Collection
    {
        $response = $this->makeApiCall('everything', [
            'q' => $theme->value,
            'sortBy' => $sortBy,
            'pageSize' => $count > 100 ? 100 : $count,
            'page' => $page
        ])->json();

        $newsCollection = collect();

        foreach ($response['articles'] as $article) {
            $newsCollection->add($this->createNewsFromArray($article, $theme));
        }

        return $newsCollection;
    }

    protected function createNewsFromArray(array $news, NewsThemeEnum $theme): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
    {
        $source = Source::query()
            ->firstOrCreate([
                'external_id' => $news['source']['id'],
                'name' => $news['source']['name']
            ]);

        $news = News::query()
            ->firstOrNew([
                'theme' => $theme->value,
                'author' => $news['author'],
                'title' => $news['title'],
                'content' => $news['content'],
                'description' => $news['description'],
                'url' => $news['url'],
                'published_at' => Carbon::parse($news['publishedAt'])
            ]);

        $news->source()->associate($source);

        $news->save();

        return $news;
    }

    protected function makeApiCall(string $action, array $params): \Illuminate\Http\Client\Response
    {
        $response = Http::withHeaders([
            'X-Api-Key' => config('newsapi.api_key')
        ])
            ->get(
                config('newsapi.api_url') . $action, $params
            );

        if ($response->failed()) throw new NewsApiCallException($response->body(), 500);

        return $response;
    }
}
