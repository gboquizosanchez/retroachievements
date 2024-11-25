<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Feed;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\{
    DataCollectionOf,
    MapName,
};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class RecentTicketData extends Data
{
    public int $count;

    public int $total;

    /**
     * @var array<int, RecentGameAward>
     */
    #[DataCollectionOf(RecentGameAward::class)]
    public array $results;
}
