<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Ticket;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class GameTicketData extends Data
{
    #[MapName('GameID')]
    public int $gameId;

    public string $gameTitle;

    public string $consoleName;

    public int $openTickets;

    #[MapName('URL')]
    public string $url;
}
