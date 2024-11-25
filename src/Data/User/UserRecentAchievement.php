<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserRecentAchievement extends Data
{
    public string $date;

    public bool $hardcoreMode;

    #[MapName('AchievementID')]
    public int $achievementId;

    public string $title;

    public string $description;

    public string $badgeName;

    public int $points;

    public int $trueRatio;

    public string | null $type;

    public string $author;

    public string $gameTitle;

    public string $gameIcon;

    #[MapName('GameID')]
    public int $gameId;

    public string $consoleName;

    #[MapName('BadgeURL')]
    public string $badgeUrl;

    #[MapName('GameURL')]
    public string $gameUrl;
}
