<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use Override;
use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserGameRankAndScoreData extends Data
{
    /**
     * @var array<int, UserGameRankAndScore>
     */
    #[DataCollectionOf(UserGameRankAndScore::class)]
    public array $rankAndScore;

    /**
     * @return array<int, UserGameRankAndScore>
     */
    #[Override]
    public function transformed(): array
    {
        return parent::transformed()['rankAndScore'];
    }
}
