<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class RecentPlayedGame extends Data
{
    #[MapName('GameID')]
    public int $gameId;

    #[MapName('ConsoleID')]
    public int $consoleId;

    public string $consoleName;

    public string $title;

    public string $imageIcon;

    public string $imageTitle;

    #[MapName('ImageIngame')]
    public string $imageInGame;

    public string $imageBoxArt;

    public string $lastPlayed;

    public int $achievementsTotal;
}
