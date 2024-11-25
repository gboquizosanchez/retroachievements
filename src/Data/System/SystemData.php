<?php

declare(strict_types=1);

namespace RetroAchievements\Data\System;

use Override;
use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\{
    DataCollectionOf,
    MapName,
};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class SystemData extends Data
{
    /**
     * @var array<int, System>
     */
    #[DataCollectionOf(System::class)]
    public array $systems;

    /**
     * @return array<int, System>
     */
    #[Override]
    public function transformed(): array
    {
        return parent::transformed()['systems'];
    }
}
