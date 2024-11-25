<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Game;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class AchievementCountData extends Data
{
    #[MapName('GameID')]
    public int $gameId;

    /**
     * @var array<int, int>
     */
    #[MapName('AchievementIDs')]
    public array $achievementIds;
}
