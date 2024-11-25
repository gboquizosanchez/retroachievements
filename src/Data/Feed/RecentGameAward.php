<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Feed;

use RetroAchievements\Data;
use RetroAchievements\Enums\AwardKind;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class RecentGameAward extends Data
{
    public string $user;

    public AwardKind $awardKind;

    public string $awardDate;

    #[MapName('GameID')]
    public int $gameId;

    public string $gameTitle;

    #[MapName('ConsoleID')]
    public int $consoleId;

    public string $consoleName;
}
