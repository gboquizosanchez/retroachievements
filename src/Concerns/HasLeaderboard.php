<?php

declare(strict_types=1);

namespace RetroAchievements\Concerns;

use RetroAchievements\Data\Leaderboard\{
    LeaderboardEntriesData,
    LeaderboardsData,
};

trait HasLeaderboard
{
    /**
     * @link https://api-docs.retroachievements.org/v1/get-game-leaderboards.html
     *
     * @return \RetroAchievements\Data\Leaderboard\LeaderboardsData|array<string, mixed>
     */
    final public function getGameLeaderboards(
        int $gameId,
        int | null $count = null,
        int | null $offset = null,
    ): LeaderBoardsData | array {
        $data = $this->call('API_GetGameLeaderboards.php', [
            'i' => $gameId,
            'c' => $count,
            'o' => $offset,
        ]);

        return $this->response($data, LeaderboardsData::class);
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-leaderboard-entries.html
     *
     * @return \RetroAchievements\Data\Leaderboard\LeaderboardEntriesData|array<string, mixed>
     */
    final public function getLeaderboardEntries(
        int $leaderboardId,
        int | null $count = null,
        int | null $offset = null,
    ): LeaderboardEntriesData | array {
        $data = $this->call('API_GetLeaderboardEntries.php', [
            'i' => $leaderboardId,
            'c' => $count,
            'o' => $offset,
        ]);

        return $this->response($data, LeaderboardEntriesData::class);
    }
}
