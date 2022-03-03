<?php

namespace App\Enums\News;

enum NewsThemeEnum: string
{
    case Bitcoin = 'bitcoin';
    case Litecoin = 'litecoin';
    case Ripple = 'ripple';
    case Dash = 'dash';
    case Ethereum = 'ethereum';
}
