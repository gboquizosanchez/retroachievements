<?php

declare(strict_types=1);

namespace RetroAchievements\Data\System;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class System extends Data
{
    #[MapName('ID')]
    public int $id;

    public string $name;

    #[MapName('IconURL')]
    public string $iconUrl;

    public bool $active;

    public bool $isGameSystem;
}
