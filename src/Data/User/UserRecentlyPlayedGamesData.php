<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserRecentlyPlayedGamesData extends Data
{
    /**
     * @var array<int, UserRecentlyPlayedGame>
     */
    #[DataCollectionOf(UserRecentlyPlayedGame::class)]
    public array $recentlyPlayedGames;

    /**
     * @return array<int, UserRecentlyPlayedGame>
     */
    public function transformed(): array
    {
        return parent::transformed()['recentlyPlayedGames'];
    }
}
