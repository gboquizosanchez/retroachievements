<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserAward extends Data
{
    public string $awardedAt;

    public string $awardType;

    public int $awardData;

    public int $awardDataExtra;

    public int $displayOrder;

    public string $title;

    public string $consoleName;

    public int | null $flags;

    public string $imageIcon;
}
