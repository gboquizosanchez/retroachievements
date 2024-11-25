<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Game;

use Override;
use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\{
    DataCollectionOf,
    MapName,
};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class RankAndScoreData extends Data
{
    /**
     * @var array<int, RankAndScore>
     */
    #[DataCollectionOf(RankAndScore::class)]
    public array $rankAndScores;

    /**
     * @return array<int, RankAndScore>
     */
    #[Override]
    public function transformed(): array
    {
        return parent::transformed()['rankAndScores'];
    }
}
