<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Feed;

use Override;
use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;

final class TopTenUserData extends Data
{
    /**
     * @var array<int, TopTenUser>
     */
    #[DataCollectionOf(TopTenUser::class)]
    public array $users;

    /**
     * @return array<int, TopTenUser>
     */
    #[Override]
    public function transformed(): array
    {
        return parent::transformed()['users'];
    }
}
