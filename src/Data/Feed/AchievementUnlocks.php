<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Feed;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class AchievementUnlocks extends Data
{
    public string $user;

    #[MapName('RAPoints')]
    public int $raPoints;

    #[MapName('RASoftcorePoints')]
    public int $raSoftcorePoints;

    public string $dateAwarded;

    public bool $hardcoreMode;
}
