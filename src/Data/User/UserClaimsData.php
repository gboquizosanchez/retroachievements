<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use Override;
use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\{
    DataCollectionOf,
    MapName,
};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserClaimsData extends Data
{
    /**
     * @var array<int, UserClaim>
     */
    #[DataCollectionOf(UserClaim::class)]
    public array $claims;

    /**
     * @return array<int, UserClaim>
     */
    #[Override]
    public function transformed(): array
    {
        return parent::transformed()['claims'];
    }
}
