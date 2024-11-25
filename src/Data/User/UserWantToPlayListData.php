<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserWantToPlayListData extends Data
{
    public int $total;

    public int $count;

    /** @var list<\RetroAchievements\Data\User\WantToPlayGame> */
    #[DataCollectionOf(WantToPlayGame::class)]
    public array $results;
}
