<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Leaderboard;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class TopEntryData extends Data
{
    public string $user;

    public int $score;

    public string $formattedScore;
}
