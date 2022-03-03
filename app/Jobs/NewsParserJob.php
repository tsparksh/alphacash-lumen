<?php

namespace App\Jobs;

use App\Contracts\News\NewsParserContract;
use App\Enums\News\NewsThemeEnum;

class NewsParserJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (NewsThemeEnum::cases() as $theme) {
            app(NewsParserContract::class)->parseNews(
                theme: $theme,
                count: 1
            );
        }
    }
}
