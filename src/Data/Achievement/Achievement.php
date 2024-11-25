<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Achievement;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class Achievement extends Data
{
    #[MapName('ID')]
    public int $id;

    public string $title;

    public string $description;

    public int $points;

    public int $trueRatio;

    public string $author;

    public string $dateCreated;

    public string $dateModified;

    public string | null $type;
}
