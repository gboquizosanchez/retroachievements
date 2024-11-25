<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Feed;

use Override;
use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\{
    DataCollectionOf,
    MapName,
};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class ClaimData extends Data
{
    /**
     * @var array<int, Claim>
     */
    #[DataCollectionOf(Claim::class)]
    public array $claims;

    /**
     * @return array<int, Claim>
     */
    #[Override]
    public function transformed(): array
    {
        return parent::transformed()['claims'];
    }
}
