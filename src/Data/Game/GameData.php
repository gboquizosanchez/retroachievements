<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Game;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class GameData extends Data
{
    #[MapName('ID')]
    public int $id;

    public string $title;

    public string $gameTitle;

    #[MapName('ConsoleID')]
    public int $consoleId;

    public string $consoleName;

    public string $console;

    #[MapName('ForumTopicID')]
    public int | null $forumTopicId;

    public int $flags;

    public string $gameIcon;

    public string $imageIcon;

    public string $imageTitle;

    #[MapName('ImageIngame')]
    public string $imageInGame;

    public string $imageBoxArt;

    public string | null $publisher;

    public string | null $developer;

    public string | null $genre;

    public string | null $released;

    public string | null $releasedAtGranularity;
}
