<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use Override;
use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\{
    DataCollectionOf,
    MapName,
};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class DateUserAchievementsData extends Data
{
    /**
     * @var array<int, DateUserAchievement>
     */
    #[DataCollectionOf(DateUserAchievement::class)]
    public array $dateUserAchievements;

    /**
     * @return array<int, DateUserAchievement>
     */
    #[Override]
    public function transformed(): array
    {
        return parent::transformed()['dateUserAchievements'];
    }
}
