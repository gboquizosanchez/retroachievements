<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserProfileData extends Data
{
    public string $user;

    public string $userPic;

    public string $memberSince;

    public string | null $richPresenceMsg;

    #[MapName('LastGameID')]
    public int $lastGameId;

    public int $contribCount;

    public int $contribYield;

    public int $totalPoints;

    public int $totalSoftcorePoints;

    public int $totalTruePoints;

    public int $permissions;

    public bool $untracked;

    #[MapName('ID')]
    public int $id;

    public bool $userWallActive;

    public string $motto;
}
