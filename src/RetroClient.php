<?php

declare(strict_types=1);

namespace RetroAchievements;

use DateTime;
use Illuminate\Support\Facades\Facade;
use Override;
use RetroAchievements\Data\User\UserCompletedGamesData;
use RetroAchievements\Enums\AchievementDistributionFlags;
use RetroAchievements\Models\RetroAchievements;

/**
 * Start user methods.
 * @method static getUserProfile(string $username)
 * @method static getUserRecentAchievements(string $username, int|null $minutes = null)
 * @method static getAchievementsEarnedBetween(string $username, DateTime $fromDate, DateTime $toDate)
 * @method static getAchievementsEarnedOnDay(string $username, DateTime $onDate)
 * @method static getGameInfoAndUserProgress(string $username, int $gameId, true|null $shouldIncludeHighestAwardMetadata = null)
 * @method static getUserCompletionProgress(string $username, int $count = 100, int $offset = 0)
 * @method static getUserAwards(string $username)
 * @method static getUserClaims(string $username)
 * @method static getUserGameRankAndScore(string $username, int $gameId)
 * @method static getUserPoints(string $username)
 * @method static getUserProgress(string $username, array $gameIds)
 * @method static getUserRecentlyPlayedGames(string $username, int $count = 10, int $offset = 0)
 * @method static getUserSummary(string $username, int $recentGamesCount = 0, int $recentAchievementsCount = 10)
 * Start game methods.
 * @method static getGame(int $gameId)
 * @method static getGameExtended(int $gameId, bool $isRequestingUnofficialAchievements = false)
 * @method static getGameHashes(int $gameId)
 * @method static getAchievementCount(int $gameId)
 * @method static getAchievementDistribution(int $gameId, AchievementDistributionFlags|null $flags = null, bool|null $hardcore = null)
 * @method static getGameRankAndScore(int $gameId, string $type)
 * Start system methods.
 * @method static getConsoleIds(bool $shouldOnlyRetrieveActiveSystems = false, bool $shouldOnlyRetrieveGameSystems = false)
 * @method static getGameList(int $consoleId, bool $shouldOnlyRetrieveGamesWithAchievements = false, bool $shouldRetrieveGameHashes = false)
 * Start achievement methods.
 * @method static getAchievementUnlocks(int $achievementId, int|null $count = null, int|null $offset = null)
 * Start feed methods.
 * @method static getRecentGameAwards(string|null $startDate = null, int|null $count = null, int|null $offset = null, array|null $desiredAwardKinds = null)
 * @method static getActiveClaims()
 * @method static getClaims(string $claimKind = 'completed')
 * @method static getTopTenUsers()
 * @method static getAchievementOfTheWeek()
 * Start ticket methods.
 * @method static getTicketData(int|string|null $ticketId = null, int|null $offset = null, int|null $count = null, true|null $isGettingMostTicketedGame = null, string|null $username = null, int|string|null $gameId = null, true|null $isGettingTicketsForUnofficialAchievements = null, true|null $shouldReturnTicketsList = null, int|string|null $achievementId = null)
 * Start comment methods.
 * @method static getComments(string $type, int|null $id = null, int|null $count = null, int|null $offset = null)
 * Start leaderboard methods.
 * @method static getGameLeaderboards(int $gameId, int|null $count = null, int|null $offset = null)
 * @method static getLeaderboardEntries(int $leaderboardId, int|null $count = null, int|null $offset = null)
 *
 * @see RetroAchievements
 */
final class RetroClient extends Facade
{
    #[Override]
    public static function getFacadeAccessor(): string
    {
        return 'retro-achievements';
    }

    /**
     * @internal It's duplicated to have IDE completion with a deprecated message.
     *
     * @link https://api-docs.retroachievements.org/v1/get-user-completed-games.html
     *
     * @uses getUserCompletionProgress instead
     *
     * @return UserCompletedGamesData|array<string, mixed>
     *
     * @deprecated
     */
    public static function getUserCompletedGames(
        string $username
    ): UserCompletedGamesData | array {
        $model = app('retro-achievements');

        assert($model instanceof RetroAchievements);

        return $model->getUserCompletedGames($username);
    }
}
