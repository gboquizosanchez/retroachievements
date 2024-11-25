<?php

declare(strict_types=1);

namespace RetroAchievements\Concerns;

use RetroAchievements\Data\Achievement\AchievementUnlocksData;

trait HasAchievement
{
    /**
     * @link https://api-docs.retroachievements.org/v1/get-achievement-unlocks.html
     *
     * @return \RetroAchievements\Data\Achievement\AchievementUnlocksData|array<string, mixed>
     */
    final public function getAchievementUnlocks(
        int $achievementId,
        int | null $count = null,
        int | null $offset = null,
    ): AchievementUnlocksData | array {
        $data = $this->call('API_GetAchievementUnlocks.php', [
            'a' => $achievementId,
            'c' => $count,
            'o' => $offset,
        ]);

        return $this->response($data, AchievementUnlocksData::class);
    }
}
