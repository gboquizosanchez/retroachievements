<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Feed;

use Spatie\LaravelData\Data;

final class TopTenUser extends Data
{
    public string $username;

    public int $totalPoints;

    public int $totalRatioPoints;
}
