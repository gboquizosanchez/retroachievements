<?php

declare(strict_types=1);

namespace RetroAchievements\Concerns;

use InvalidArgumentException;
use RetroAchievements\Data\Feed\{
    ClaimData,
    RecentTicketData,
    TopTenUserData,
};

trait HasFeed
{
    /**
     * @link https://api-docs.retroachievements.org/v1/get-recent-game-awards.html
     *
     * @param array<int, string>|null $desiredAwardKinds
     *
     * @return \RetroAchievements\Data\Feed\RecentTicketData|array<string, mixed>
     */
    final public function getRecentGameAwards(
        string | null $startDate = null,
        int | null $count = null,
        int | null $offset = null,
        array | null $desiredAwardKinds = null,
    ): RecentTicketData | array {
        $data = $this->call('API_GetRecentGameAwards.php', [
            'd' => $startDate,
            'c' => $count,
            'o' => $offset,
            'k' => is_array($desiredAwardKinds)
                ? implode(',', $desiredAwardKinds)
                : $desiredAwardKinds,
        ]);

        return $this->response($data, RecentTicketData::class);
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-active-claims.html
     *
     * @return \RetroAchievements\Data\Feed\ClaimData|array<string, mixed>
     */
    final public function getActiveClaims(): ClaimData | array
    {
        $response = $this->call('API_GetActiveClaims.php');

        return $this->response($response, ClaimData::class, 'claims');
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-claims.html
     *
     * @return \RetroAchievements\Data\Feed\ClaimData|array<string, mixed>
     */
    final public function getClaims(
        string $claimKind = 'completed',
    ): ClaimData | array {
        $status = [
            'completed',
            'dropped',
            'expired',
        ];

        if (! in_array($claimKind, $status)) {
            throw new InvalidArgumentException(
                "Invalid claim kind: {$claimKind}. Valid values are: completed, dropped or expired",
            );
        }

        $mapValues = [
            'completed' => '1',
            'dropped' => '2',
            'expired' => '3',
        ];

        $response = $this->call('API_GetClaims.php', [
            'k' => $mapValues[$claimKind],
        ]);

        return $this->response($response, ClaimData::class, 'claims');
    }

    /**
     * @link https://api-docs.retroachievements.org/v1/get-top-ten-users.html
     *
     * @return \RetroAchievements\Data\Feed\TopTenUserData|array<string, mixed>
     */
    final public function getTopTenUsers(): TopTenUserData | array
    {
        $data = $this->call('API_GetTopTenUsers.php');

        if (config('retro-achievements.mapping.raw_properties')) {
            return $data;
        }

        $items = [];

        foreach ($data as $item) {
            [$user, $points, $ratioPoints] = $item;

            $items[] = [
                'username' => $user,
                'totalPoints' => $points,
                'totalRatioPoints' => $ratioPoints,
            ];
        }

        return $this->response(['users' => $items], TopTenUserData::class);
    }
}
