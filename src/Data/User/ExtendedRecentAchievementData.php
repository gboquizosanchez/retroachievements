<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use Override;
use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;

final class ExtendedRecentAchievementData extends Data
{
    /**
     * @var array<int, ExtendedRecentAchievement>
     */
    #[DataCollectionOf(ExtendedRecentAchievement::class)]
    public array $extendedRecentAchievements;

    /**
     * @return array<int, ExtendedRecentAchievement>
     */
    #[Override]
    public function transformed(): array
    {
        return parent::transformed()['extendedRecentAchievements'];
    }
}
