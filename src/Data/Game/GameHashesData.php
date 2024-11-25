<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Game;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class GameHashesData extends Data
{
    /**
     * @var array<int, GameHash>
     */
    #[DataCollectionOf(GameHash::class)]
    public array $results;
}
