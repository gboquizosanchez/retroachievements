<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data\Game\GameExtendedData;
use RetroAchievements\Enums\AwardKind;
use Spatie\LaravelData\Attributes\{
    DataCollectionOf,
    MapName,
};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class GameInfoAndUserProgressData extends GameExtendedData
{
    #[DataCollectionOf(AchievementWithUserProgress::class)]
    public array $achievements;

    public int $numAwardedToUser;

    public int $numAwardedToUserHardcore;

    public string $userCompletion;

    public string $userCompletionHardcore;

    public AwardKind | null $highestAwardKind;

    public string $highestAwardDate;

    #[MapName('players_total')]
    public int $playersTotal;

    #[MapName('achievements_published')]
    public int $achievementsPublished;

    #[MapName('points_total')]
    public int $pointsTotal;

    #[MapName('GuideURL')]
    public string | null $guideUrl;
}
