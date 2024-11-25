<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Ticket;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class ReportGame extends Data
{
    #[MapName('GameID')]
    public int $gameId;

    public string $gameTitle;

    public string $gameIcon;

    public string $console;

    public int $openTickets;
}
