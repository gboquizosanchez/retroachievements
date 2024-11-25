<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Leaderboard;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class LeaderboardEntriesData extends Data
{
    public int $count;

    public int $total;

    /** @var list<\RetroAchievements\Data\Leaderboard\LeaderboardEntry> */
    #[DataCollectionOf(LeaderboardEntry::class)]
    public array $results;
}
