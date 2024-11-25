<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Leaderboard;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class Leaderboard extends Data
{
    #[MapName('ID')]
    public int $id;

    public bool $rankAsc;

    public string $title;

    public string $description;

    public string $format;

    public TopEntryData $topEntry;
}
