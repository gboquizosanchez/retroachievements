<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Ticket;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class Ticket extends Data
{
    #[MapName('ID')]
    public int $id;

    #[MapName('AchievementID')]
    public int $achievementId;

    public string $achievementTitle;

    public string $achievementDesc;

    public string | null $achievementType;

    public int $points;

    public string $badgeName;

    public string $achievementAuthor;

    #[MapName('GameID')]
    public int $gameId;

    public string $consoleName;

    public string $gameTitle;

    public string $gameIcon;

    public string $reportedAt;

    public int $reportType;

    public int $reportState;

    public int | null $hardcore;

    public string $reportNotes;

    public string $reportedBy;

    public string | null $resolvedAt;

    public string | null $resolvedBy;

    public string $reportStateDescription;

    public string $reportTypeDescription;

    #[MapName('URL')]
    public string $url;
}
