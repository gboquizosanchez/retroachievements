<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Game;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class GameHash extends Data
{
    #[MapName('MD5')]
    public string $md5;

    public string $name;

    /**
     * @var array<int, string>
     */
    public array $labels;

    public string | null $patchUrl;
}
