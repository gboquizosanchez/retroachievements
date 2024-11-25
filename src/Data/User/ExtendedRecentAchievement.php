<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class ExtendedRecentAchievement extends Data
{
    #[MapName('ID')]
    public int $id;

    #[MapName('GameID')]
    public int $gameId;

    public string $gameTitle;

    public string $title;

    public string $description;

    public int $points;

    public string | null $type;

    public string $badgeName;

    public bool $isAwarded;

    public string $dateAwarded;

    public bool $hardcoreAchieved;
}
