<?php

declare(strict_types=1);

namespace RetroAchievements\Data\System;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class Game extends Data
{
    public string $title;

    #[MapName('ID')]
    public int $id;

    #[MapName('ConsoleID')]
    public int $consoleId;

    public string $consoleName;

    public string $imageIcon;

    public int $numAchievements;

    public int $numLeaderboards;

    public int $points;

    public string | null $dateModified;

    #[MapName('ForumTopicID')]
    public int | null $forumTopicId;

    /** @var array<int, string> */
    public array $hashes;
}
