<?php

declare(strict_types=1);

namespace RetroAchievements\Concerns;

use DateTime;
use RetroAchievements\Data\User\{
    DateUserAchievementsData,
    GameInfoAndUserProgressData,
    UserAwardsData,
    UserClaimsData,
    UserCompletedGamesData,
    UserCompletionProgressData,
    UserGameRankAndScoreData,
    UserPointsData,
    UserProfileData,
    UserProgressData,
    UserRecentAchievementsData,
    UserRecentlyPlayedGamesData,
    UserSummaryData,
    UserWantToPlayListData,
};

trait HasUser
{
    /**
     * @link https://api-docs.retroachievements.org/v1/get-user-profile.html
     *
     * @return \RetroAchievements\Data\User\UserProfileData|array<string, mixed>
     */
    final public function getUserProfile(string $username): UserProfileData | array
    {
        $data = $this->call('API_GetUserProfile.php', [
            'u' => $username,
        ]);

        return $this->response($data, UserProfileData::class);
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-user-recent-achievements.html
     *
     *  @return \RetroAchievements\Data\User\UserRecentAchievementsData|array<string, mixed>
     */
    final public function getUserRecentAchievements(
        string $username,
        int | null $minutes = null,
    ): UserRecentAchievementsData | array {
        $response = $this->call('API_GetUserRecentAchievements.php', [
            'u' => $username,
            'm' => $minutes,
        ]);

        return $this->response(
            $response,
            UserRecentAchievementsData::class,
            'userRecentAchievements',
        );
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-achievements-earned-between.html
     *
     * @return \RetroAchievements\Data\User\DateUserAchievementsData|array<string, mixed>
     */
    final public function getAchievementsEarnedBetween(
        string $username,
        DateTime $fromDate,
        DateTime $toDate,
    ): DateUserAchievementsData | array {
        $response = $this->call('API_GetAchievementsEarnedBetween.php', [
            'u' => $username,
            'f' => $fromDate->getTimestamp(),
            't' => $toDate->getTimestamp(),
        ]);

        return $this->response(
            $response,
            DateUserAchievementsData::class,
            'dateUserAchievements',
        );
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-achievements-earned-on-day.html
     *
     * @return \RetroAchievements\Data\User\DateUserAchievementsData|array<string, mixed>
     */
    final public function getAchievementsEarnedOnDay(
        string $username,
        DateTime $onDate,
    ): DateUserAchievementsData | array {
        $response = $this->call('API_GetAchievementsEarnedOnDay.php', [
            'u' => $username,
            'd' => $onDate->format('Y-m-d'),
        ]);

        return $this->response(
            $response,
            DateUserAchievementsData::class,
            'dateUserAchievements',
        );
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-game-info-and-user-progress.html
     *
     * @return \RetroAchievements\Data\User\GameInfoAndUserProgressData|array<string, mixed>
     */
    final public function getGameInfoAndUserProgress(
        string $username,
        int $gameId,
        true | null $shouldIncludeHighestAwardMetadata = null,
    ): GameInfoAndUserProgressData | array {
        $data = $this->call('API_GetGameInfoAndUserProgress.php', [
            'u' => $username,
            'g' => $gameId,
            'a' => $shouldIncludeHighestAwardMetadata,
        ]);

        return $this->response($data, GameInfoAndUserProgressData::class);
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-user-completion-progress.html
     *
     * @return \RetroAchievements\Data\User\UserCompletionProgressData|array<string, mixed>
     */
    final public function getUserCompletionProgress(
        string $username,
        int | null $count = null,
        int | null $offset = null,
    ): UserCompletionProgressData | array {
        $data = $this->call('API_GetUserCompletionProgress.php', [
            'u' => $username,
            'c' => $count,
            'o' => $offset,
        ]);

        return $this->response($data, UserCompletionProgressData::class);
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-user-awards.html
     *
     * @return \RetroAchievements\Data\User\UserAwardsData|array<string, mixed>
     */
    final public function getUserAwards(string $username): UserAwardsData | array
    {
        $data = $this->call('API_GetUserAwards.php', [
            'u' => $username,
        ]);

        return $this->response($data, UserAwardsData::class);
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-user-claims.html
     *
     * @return \RetroAchievements\Data\User\UserClaimsData|array<string, mixed>
     */
    final public function getUserClaims(string $username): UserClaimsData | array
    {
        $response = $this->call('API_GetUserClaims.php', [
            'u' => $username,
        ]);

        return $this->response($response, UserClaimsData::class, 'claims');
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-user-game-rank-and-score.html
     *
     * @return \RetroAchievements\Data\User\UserGameRankAndScoreData|array<string, mixed>
     */
    final public function getUserGameRankAndScore(
        string $username,
        int $gameId,
    ): UserGameRankAndScoreData | array {
        $data = $this->call('API_GetUserGameRankAndScore.php', [
            'u' => $username,
            'g' => $gameId,
        ]);

        return $this->response(
            $data,
            UserGameRankAndScoreData::class,
            'rankAndScore',
        );
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-user-points.html
     *
     * @return \RetroAchievements\Data\User\UserPointsData|array<string, mixed>
     */
    final public function getUserPoints(string $username): UserPointsData | array
    {
        $data = $this->call('API_GetUserPoints.php', [
            'u' => $username,
        ]);

        return $this->response($data, UserPointsData::class);
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-user-progress.html
     *
     * @param  array<int, string|int>  $gameIds
     *
     * @return \RetroAchievements\Data\User\UserProgressData|array<string, mixed>
     */
    final public function getUserProgress(
        string $username,
        array $gameIds,
    ): UserProgressData | array {
        $data = $this->call('API_GetUserProgress.php', [
            'u' => $username,
            'i' => implode(',', $gameIds),
        ]);

        return $this->response($data, UserProgressData::class, 'progress');
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-user-recently-played-games.html
     *
     * @return \RetroAchievements\Data\User\UserRecentlyPlayedGamesData|array<string, mixed>
     */
    final public function getUserRecentlyPlayedGames(
        string $username,
        int | null $count = null,
        int | null $offset = null,
    ): UserRecentlyPlayedGamesData | array {
        $data = $this->call('API_GetUserRecentlyPlayedGames.php', [
            'u' => $username,
            'c' => $count,
            'o' => $offset,
        ]);

        return $this->response(
            $data,
            UserRecentlyPlayedGamesData::class,
            'recentlyPlayedGames',
        );
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-user-summary.html
     *
     * @return \RetroAchievements\Data\User\UserSummaryData|array<string, mixed>
     */
    final public function getUserSummary(
        string $username,
        int | null $recentGamesCount = null,
        int | null $recentAchievementsCount = null,
    ): UserSummaryData | array {
        $data = $this->call('API_GetUserSummary.php', [
            'u' => $username,
            'g' => $recentGamesCount,
            'a' => $recentAchievementsCount,
        ]);

        return $this->response($data, UserSummaryData::class);
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-user-completed-games.html
     *
     * @return \RetroAchievements\Data\User\UserCompletedGamesData|array<string, mixed>
     *
     * @deprecated and added to keep updated the API docs.
     *
     * @uses getUserCompletionProgress instead
     */
    final public function getUserCompletedGames(
        string $username,
    ): UserCompletedGamesData | array {
        $data = $this->call('API_GetUserCompletedGames.php', [
            'u' => $username,
        ]);

        return $this->response(
            $data,
            UserCompletedGamesData::class,
            'completedGames',
        );
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-user-want-to-play-list.html
     *
     * @return \RetroAchievements\Data\User\UserWantToPlayListData|array<string, mixed>
     */
    final public function getUserWantToPlayList(
        string $username,
        int | null $count = null,
        int | null $offset = null,
    ): UserWantToPlayListData | array {
        $data = $this->call('API_GetUserWantToPlayList.php', [
            'u' => $username,
            'c' => $count,
            'o' => $offset,
        ]);

        return $this->response($data, UserWantToPlayListData::class);
    }
}
