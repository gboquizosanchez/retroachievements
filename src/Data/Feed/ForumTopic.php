<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Feed;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;

final class ForumTopic extends Data
{
    #[MapName('ID')]
    public int $id;
}
