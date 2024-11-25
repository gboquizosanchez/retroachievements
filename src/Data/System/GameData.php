<?php

declare(strict_types=1);

namespace RetroAchievements\Data\System;

use Override;
use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\{
    DataCollectionOf,
    MapName,
};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class GameData extends Data
{
    /**
     * @var array<int, Game>
     */
    #[DataCollectionOf(Game::class)]
    public array $games;

    /**
     * @return array<int, Game>
     */
    #[Override]
    public function transformed(): array
    {
        return parent::transformed()['games'];
    }
}
