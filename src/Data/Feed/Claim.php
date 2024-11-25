<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Feed;

use RetroAchievements\Data;
use RetroAchievements\Enums\ClaimType;
use RetroAchievements\Enums\Feed\{
    ClaimStatus,
    SetType,
};
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class Claim extends Data
{
    #[MapName('ID')]
    public int $id;

    public string $user;

    #[MapName('GameID')]
    public int $gameId;

    public string $gameTitle;

    public string $gameIcon;

    #[MapName('ConsoleID')]
    public int $consoleId;

    public string $consoleName;

    public ClaimType $claimType;

    public SetType $setType;

    public ClaimStatus $status;

    public int $extension;

    public int $special;

    public string $created;

    public string $doneTime;

    public string $updated;

    public bool $userIsJrDev;

    public int $minutesLeft;
}
