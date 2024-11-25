<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data\Game\Achievement;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class AchievementWithUserProgress extends Achievement
{
    public string $dateEarned;

    public string $dateEarnedHardcore;
}
