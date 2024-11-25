<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Ticket;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class AchievementTicketData extends Data
{
    #[MapName('AchievementID')]
    public int $achievementId;

    public string $achievementTitle;

    public string $achievementDescription;

    #[MapName('URL')]
    public string $url;

    public int $openTickets;
}
