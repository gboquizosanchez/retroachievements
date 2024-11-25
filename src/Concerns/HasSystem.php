<?php

declare(strict_types=1);

namespace RetroAchievements\Concerns;

use RetroAchievements\Data\System\{
    GameData,
    SystemData,
};

trait HasSystem
{
    /**
     * @link https://api-docs.retroachievements.org/v1/get-console-ids.html
     *
     * @return \RetroAchievements\Data\System\SystemData|array<string, mixed>
     */
    final public function getConsoleIds(
        bool $shouldOnlyRetrieveActiveSystems = false,
        bool $shouldOnlyRetrieveGameSystems = false,
    ): SystemData | array {
        $data = $this->call('API_GetConsoleIDs.php', [
            'a' => $shouldOnlyRetrieveActiveSystems,
            'g' => $shouldOnlyRetrieveGameSystems,
        ]);

        return $this->response($data, SystemData::class, 'systems');
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-game-list.html
     *
     * @return \RetroAchievements\Data\System\GameData|array<string, mixed>
     */
    final public function getGameList(
        int $consoleId,
        bool $shouldOnlyRetrieveGamesWithAchievements = false,
        bool $shouldRetrieveGameHashes = false,
    ): GameData | array {
        $data = $this->call('API_GetGameList.php', [
            'i' => $consoleId,
            'f' => $shouldOnlyRetrieveGamesWithAchievements,
            'h' => $shouldRetrieveGameHashes,
        ]);

        return $this->response($data, GameData::class, 'games');
    }
}
