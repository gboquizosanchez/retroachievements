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
final class UserCompletionProgressData extends Data
{
    public int $count;

    public int $total;

    /** @var list<\RetroAchievements\Data\User\UserCompletionProgress> */
    #[DataCollectionOf(UserCompletionProgress::class)]
    public array $results;
}
