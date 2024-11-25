<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserCompletedGame extends Data
{
    #[MapName('GameID')]
    public int $gameId;

    public string $title;

    public string $imageIcon;

    #[MapName('ConsoleID')]
    public string $consoleID;

    public string $consoleName;

    public int $maxPossible;

    public int $numAwarded;

    public int $pctWon;

    public int $hardcoreMode;
}
