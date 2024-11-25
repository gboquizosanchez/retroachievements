<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class LastGame extends Data
{
    #[MapName('ID')]
    public int $id;

    public string $title;

    #[MapName('ConsoleID')]
    public int $consoleId;

    public string $consoleName;

    #[MapName('ForumTopicID')]
    public int $forumTopicId;

    public int $flags;

    public string $imageIcon;

    public string $imageTitle;

    #[MapName('ImageIngame')]
    public string $imageInGame;

    public string $imageBoxArt;

    public string $publisher;

    public string $developer;

    public string $genre;

    public string $released;

    public bool $isFinal;
}
