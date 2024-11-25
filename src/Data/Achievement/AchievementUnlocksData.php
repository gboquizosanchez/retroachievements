<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Achievement;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\{
    DataCollectionOf,
    MapName,
};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class AchievementUnlocksData extends Data
{
    public Achievement $achievement;

    public Console $console;

    public Game $game;

    public int $unlocksCount;

    public int $unlocksHardcoreCount;

    public int $totalPlayers;

    /**
     * @var array<int, AchievementUnlocks>
     */
    #[DataCollectionOf(AchievementUnlocks::class)]
    public array $unlocks;
}
