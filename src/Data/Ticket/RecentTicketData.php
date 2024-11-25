<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Ticket;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\{
    DataCollectionOf,
    MapName,
};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class RecentTicketData extends Data
{
    public int $openTickets;

    #[MapName('URL')]
    public string $url;

    /**
     * @var array<int, Ticket>
     */
    #[DataCollectionOf(Ticket::class)]
    public array $recentTickets;
}
