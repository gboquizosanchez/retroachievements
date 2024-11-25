<?php

declare(strict_types=1);

use RetroAchievements\Data\Leaderboard\LeaderboardsData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasLeaderboard::getGameLeaderboards */
beforeEach(function (): void {
    Http::fake(['*' => fakeGameLeaderboards()]);
});

function fakeGameLeaderboards(): array
{
    return [
        'Count' => 1,
        'Total' => 1,
        'Results' => [
            [
                'ID' => 48638,
                'RankAsc' => true,
                'Title' => 'November 2022 - Leaderboard of the Month - Green Hill Act 3',
                'Description' => 'Complete this act in the fastest time!',
                'Format' => 'TIME',
                'TopEntry' => [
                    'User' => 'Alexdatadestroyer',
                    'Score' => 1986,
                    'FormattedScore' => '0:33.10',
                ],
            ],
        ],
    ];
}

function expectedGameLeaderboards(): array
{
    return [
        'count' => 1,
        'total' => 1,
        'results' => [
            [
                'id' => 48638,
                'rankAsc' => true,
                'title' => 'November 2022 - Leaderboard of the Month - Green Hill Act 3',
                'description' => 'Complete this act in the fastest time!',
                'format' => 'TIME',
                'topEntry' => [
                    'user' => 'Alexdatadestroyer',
                    'score' => 1986,
                    'formattedScore' => '0:33.10',
                ],
            ],
        ],
    ];
}

it('retrieves a list of leaderboards for a game', function (): void {
    $response = RetroClient::getGameLeaderboards(gameId: 1);

    expect($response)
        ->toBeInstanceOf(LeaderboardsData::class)
        ->and($response->transformed())
        ->toBe(expectedGameLeaderboards());
});

it('retrieves a list of leaderboards for a game in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGameLeaderboards(gameId: 1);

    expect($response)
        ->toBe(expectedGameLeaderboards());
});

it('retrieves a list of leaderboards for a game in array mode with RAW Properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGameLeaderboards(gameId: 1);

    expect($response)
        ->toBe(fakeGameLeaderboards());
});
