<?php

declare(strict_types=1);

namespace RetroAchievements\Concerns;

use RetroAchievements\Data\Feed\AchievementOfTheWeekData;

trait HasEvent
{
    /**
     * @link https://api-docs.retroachievements.org/v1/get-achievement-of-the-week.html
     *
     * @return \RetroAchievements\Data\Feed\AchievementOfTheWeekData|array<string, mixed>
     */
    final public function getAchievementOfTheWeek(): AchievementOfTheWeekData | array
    {
        $data = $this->call('API_GetAchievementOfTheWeek.php');

        return $this->response($data, AchievementOfTheWeekData::class);
    }
}
