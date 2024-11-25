<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Game;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
class Achievement extends Data
{
    #[MapName('ID')]
    public int $id;

    public int | null $numAwarded;

    public int | null $numAwardedHardcore;

    public string $title;

    public string $description;

    public int $points;

    public int $trueRatio;

    public string $author;

    public string $dateModified;

    public string $dateCreated;

    public string $badgeName;

    public int $displayOrder;

    public string $memAddr;

    #[MapName('type')]
    public string | null $type;
}
