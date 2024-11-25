<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\{
    DataCollectionOf,
    MapName,
};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserAwardsData extends Data
{
    public int $totalAwardsCount;

    public int $hiddenAwardsCount;

    public int $masteryAwardsCount;

    public int $completionAwardsCount;

    public int $beatenHardcoreAwardsCount;

    public int $beatenSoftcoreAwardsCount;

    public int $eventAwardsCount;

    public int $siteAwardsCount;

    /**
     * @var array<int, UserAward>
     */
    #[DataCollectionOf(UserAward::class)]
    public array $visibleUserAwards;
}
