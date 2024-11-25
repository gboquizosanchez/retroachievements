<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Leaderboard;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class LeaderboardEntry extends Data
{
    public int $rank;

    public string $user;

    public int $score;

    public string $formattedScore;

    public string $dateSubmitted;
}
