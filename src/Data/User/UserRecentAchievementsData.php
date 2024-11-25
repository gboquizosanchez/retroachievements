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
final class UserRecentAchievementsData extends Data
{
    /**
     * @var array<int, UserRecentAchievement>
     */
    #[DataCollectionOf(UserRecentAchievement::class)]
    public array $userRecentAchievements;

    /**
     * @return array<int, UserRecentAchievement>
     */
    #[Override]
    public function transformed(): array
    {
        return parent::transformed()['userRecentAchievements'];
    }
}
