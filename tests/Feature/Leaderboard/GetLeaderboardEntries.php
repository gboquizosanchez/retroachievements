<?php

declare(strict_types=1);

use RetroAchievements\Data\Leaderboard\LeaderboardEntriesData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasLeaderboard::getLeaderboardEntries */
beforeEach(function (): void {
    Http::fake(['*' => fakeLeaderboardsEntries()]);
});

function fakeLeaderboardsEntries(): array
{
    return  [
        'Count' => 1,
        'Total' => 1,
        'Results' => [
            [
                'Rank' => 1,
                'User' => 'ramenoid',
                'Score' => 1_908_730,
                'FormattedScore' => '1,908,730',
                'DateSubmitted' => '2024-10-05T18:30:59+00:00',
            ],
        ],
    ];
}

function expectedLeaderboardsEntries(): array
{
    return [
        'count' => 1,
        'total' => 1,
        'results' => [
            [
                'rank' => 1,
                'user' => 'ramenoid',
                'score' => 1_908_730,
                'formattedScore' => '1,908,730',
                'dateSubmitted' => '2024-10-05T18:30:59+00:00',
            ],
        ],
    ];
}

it('retrieves a list of leaderboard entries', function (): void {
    $response = RetroClient::getLeaderboardEntries(leaderboardId: 104_370);

    expect($response)
        ->toBeInstanceOf(LeaderboardEntriesData::class)
        ->and($response->transformed())
        ->toBe(expectedLeaderboardsEntries());
});

it('retrieves a list of leaderboard entries in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getLeaderboardEntries(leaderboardId: 104_370);

    expect($response)
        ->toBe(expectedLeaderboardsEntries());
});

it('retrieves a list of leaderboard entries in array mode with RAW Properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getLeaderboardEntries(leaderboardId: 104_370);

    expect($response)
        ->toBe(fakeLeaderboardsEntries());
});
