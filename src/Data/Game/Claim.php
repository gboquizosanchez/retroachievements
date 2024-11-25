<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Game;

use RetroAchievements\Data;
use RetroAchievements\Enums\ClaimType;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class Claim extends Data
{
    public string $user;

    public int $setType;

    #[MapName('GameID')]
    public int $gameId;

    public ClaimType $claimType;

    public string $created;

    public string $expiration;
}
