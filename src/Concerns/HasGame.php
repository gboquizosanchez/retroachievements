<?php

declare(strict_types=1);

namespace RetroAchievements\Concerns;

use InvalidArgumentException;
use RetroAchievements\Data\Game\{
    AchievementCountData,
    GameData,
    GameExtendedData,
    GameHashesData,
    RankAndScoreData,
};
use RetroAchievements\Enums\AchievementDistributionFlags;

trait HasGame
{
    /**
     * @link https://api-docs.retroachievements.org/v1/get-game.html
     *
     * @return \RetroAchievements\Data\Game\GameData|array<string, mixed>
     */
    final public function getGame(int $gameId): GameData | array
    {
        $data = $this->call('API_GetGame.php', [
            'i' => $gameId,
        ]);

        return $this->response($data, GameData::class);
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-game-extended.html
     *
     * @return \RetroAchievements\Data\Game\GameExtendedData|array<string, mixed>
     */
    final public function getGameExtended(
        int $gameId,
        bool $isRequestingUnofficialAchievements = false,
    ): GameExtendedData | array {
        $data = $this->call('API_GetGameExtended.php', [
            'i' => $gameId,
            'f' => $isRequestingUnofficialAchievements
                ? AchievementDistributionFlags::UnofficialAchievements->value
                : null,
        ]);

        return $this->response($data, GameExtendedData::class);
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-game-hashes.html
     *
     * @return \RetroAchievements\Data\Game\GameHashesData|array<string, mixed>
     */
    final public function getGameHashes(int $gameId): GameHashesData | array
    {
        $data = $this->call('API_GetGameHashes.php', [
            'i' => $gameId,
        ]);

        return $this->response($data, GameHashesData::class);
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-achievement-count.html
     *
     * @return \RetroAchievements\Data\Game\AchievementCountData|array<string, mixed>
     */
    final public function getAchievementCount(int $gameId): AchievementCountData | array
    {
        $data = $this->call('API_GetAchievementCount.php', [
            'i' => $gameId,
        ]);

        return $this->response($data, AchievementCountData::class);
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-achievement-distribution.html
     *
     * @return array<string, mixed>
     */
    final public function getAchievementDistribution(
        int $gameId,
        AchievementDistributionFlags | null $flags = null,
        bool | null $hardcore = null,
    ): array {
        return $this->call(
            endpoint: 'API_GetAchievementDistribution.php',
            parameters: [
                'i' => $gameId,
                'f' => $flags->value ?? null,
                'h' => (int) $hardcore,
            ],
            filtered: false,
        );
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-game-rank-and-score.html
     *
     * @return \RetroAchievements\Data\Game\RankAndScoreData|array<string, mixed>
     */
    final public function getGameRankAndScore(
        int $gameId,
        string $type,
    ): RankAndScoreData | array {
        if (! in_array($type, ['latest-masters', 'high-scores'])) {
            throw new InvalidArgumentException(
                "Invalid type: {$type}. Valid values are: latest-masters or high-scores",
            );
        }

        $data = $this->call('API_GetGameRankAndScore.php', [
            'g' => $gameId,
            't' => (int) ($type === 'latest-masters'),
        ]);

        return $this->response($data, RankAndScoreData::class, 'rankAndScores');
    }
}
