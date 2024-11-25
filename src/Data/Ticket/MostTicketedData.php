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
final class MostTicketedData extends Data
{
    /**
     * @var array<int, ReportGame>
     */
    #[DataCollectionOf(ReportGame::class)]
    public array $mostReportedGames;

    #[MapName('URL')]
    public string $url;
}
