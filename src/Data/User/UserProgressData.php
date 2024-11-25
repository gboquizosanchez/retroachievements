<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserProgressData extends Data
{
    /** @var array<int, UserProgress> */
    #[DataCollectionOf(UserProgress::class)]
    public array $progress;

    /** @return array<int, UserProgress> */
    public function transformed(): array
    {
        return parent::transformed()['progress'];
    }
}
