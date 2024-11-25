<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Achievement;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class Game extends Data
{
    #[MapName('ID')]
    public int $id;

    public string $title;
}
