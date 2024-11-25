<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;

final class UserLastActivity extends Data
{
    public int $id = 0;

    public string | null $timestamp;

    #[MapName('lastupdate')]
    public string | null $lastUpdate;

    #[MapName('activitytype')]
    public string | null $activityType;

    #[MapName('User')]
    public string $user;

    public string | null $data;

    public string | null $data2;
}
