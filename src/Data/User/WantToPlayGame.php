<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class WantToPlayGame extends Data
{
    #[MapName('ID')]
    public int $id;

    public string $title;

    public string $imageIcon;

    #[MapName('ConsoleID')]
    public int $consoleId;

    public string $consoleName;

    public int $pointsTotal;

    public int $achievementsPublished;
}
