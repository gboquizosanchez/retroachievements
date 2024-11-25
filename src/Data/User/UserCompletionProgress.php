<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use RetroAchievements\Enums\AwardKind;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserCompletionProgress extends Data
{
    #[MapName('GameID')]
    public int $gameId;

    public string $title;

    public string $imageIcon;

    #[MapName('ConsoleID')]
    public int $consoleId;

    public string $consoleName;

    public int $maxPossible;

    public int $numAwarded;

    public int $numAwardedHardcore;

    public string $mostRecentAwardedDate;

    public AwardKind | null $highestAwardKind;

    public string | null $highestAwardDate;
}
