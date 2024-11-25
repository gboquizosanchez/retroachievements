<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserCompletedGamesData extends Data
{
    /** @var list<\RetroAchievements\Data\User\UserCompletedGame> */
    #[DataCollectionOf(UserCompletedGame::class)]
    public array $completedGames;

    /** @return list<\RetroAchievements\Data\User\UserCompletedGame> */
    public function transformed(): array
    {
        return parent::transformed()['completedGames'];
    }
}
