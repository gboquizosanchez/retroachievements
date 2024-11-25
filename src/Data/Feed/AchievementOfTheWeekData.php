<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Feed;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\{
    DataCollectionOf,
    MapName,
};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class AchievementOfTheWeekData extends Data
{
    #[MapName('ID')]
    public int $id;

    public string $title;

    public string $description;

    public int $points;

    public int $trueRatio;

    public string $author;

    public string | null $type;

    public string $badgeName;

    public string $dateCreated;

    public string $dateModified;

    public string $badgeUrl;

    public Console $console;

    public ForumTopic $forumTopic;

    public Game $game;

    public string $startAt;

    public int $totalPlayers;

    /**
     * @var array<int, AchievementUnlocks>
     */
    #[DataCollectionOf(AchievementUnlocks::class)]
    public array $unlocks;

    public int $unlocksCount;

    public int $unlocksHardcoreCount;
}
