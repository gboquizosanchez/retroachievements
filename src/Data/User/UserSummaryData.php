<?php

declare(strict_types=1);

namespace RetroAchievements\Data\User;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\{
    DataCollectionOf,
    MapName,
};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class UserSummaryData extends Data
{
    public string $user;

    public string $memberSince;

    public UserLastActivity $lastActivity;

    public string $richPresenceMsg;

    #[MapName('LastGameID')]
    public int $lastGameId;

    public int $contribCount;

    public int $contribYield;

    public int $totalPoints;

    public int $totalSoftcorePoints;

    public int $totalTruePoints;

    public int $permissions;

    public bool $untracked;

    #[MapName('ID')]
    public int $id;

    public bool $userWallActive;

    public string $motto;

    public int $rank;

    public int $recentlyPlayedCount;

    /**
     * @var array<int, RecentPlayedGame>
     */
    #[DataCollectionOf(RecentPlayedGame::class)]
    public array $recentlyPlayed;

    /**
     * @var array<int, AwardedGame>
     */
    #[DataCollectionOf(AwardedGame::class)]
    public array $awarded;

    /**
     * @var array<int, array<int, ExtendedRecentAchievement>>
     */
    public array $recentAchievements;

    public LastGame $lastGame;

    public string $userPic;

    public int $totalRanked;

    public string $status;

    /** @phpstan-ignore-next-line */
    public static function from(...$payloads): static
    {
        $userSummaryData = static::factory()->from(...$payloads);
        $userSummaryData->recentAchievements = [];

        if (isset($payloads[0]['RecentAchievements'])) {
            $recentAchievements = $payloads[0]['RecentAchievements'];

            foreach ($recentAchievements as $gameId => $achievements) {
                foreach ($achievements as $achievementId => $achievementData) {
                    $userSummaryData->recentAchievements[(int) $gameId][(int) $achievementId] =
                        ExtendedRecentAchievement::from($achievementData);
                }
            }
        }

        return $userSummaryData;
    }

    /**
     * @return array<string, mixed>
     */
    public function transformed(): array
    {
        $transformed = parent::transformed();

        if (isset($transformed['recentAchievements'])) {
            foreach ($this->recentAchievements as $gameId => $achievements) {
                foreach ($achievements as $achievementId => $achievementData) {
                    assert($achievementData instanceof ExtendedRecentAchievement);

                    $transformed['recentAchievements'][$gameId][$achievementId] =
                        $achievementData->transformed();
                }
            }
        }

        return $transformed;
    }
}
