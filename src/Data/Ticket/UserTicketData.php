<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Ticket;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserTicketData extends Data
{
    public string $user;

    public int $open;

    public int $closed;

    public int $resolved;

    public int $total;

    #[MapName('URL')]
    public string $url;
}
