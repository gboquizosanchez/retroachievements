<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Game;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class RankAndScore extends Data
{
    public string $user;

    public int $numAchievements;

    public int $totalScore;

    public string $lastAward;
}
