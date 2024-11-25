<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserProgress extends Data
{
    public int $numPossibleAchievements;

    public int $possibleScore;

    public int $numAchieved;

    public int $scoreAchieved;

    public int $numAchievedHardcore;

    public int $scoreAchievedHardcore;
}
