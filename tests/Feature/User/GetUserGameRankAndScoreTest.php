<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\UserGameRankAndScoreData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getUserGameRankAndScore */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeUserGameRankAndScore(),
    ]);
});

function fakeUserGameRankAndScore(): array
{
    return [
        [
            'User' => 'Cheke',
            'Rank' => 33581,
            'Score' => 5,
            'LastAward' => '2024-01-26 00:28:54',
        ],
    ];
}

function expectedUserGameRankAndScore(): array
{
    return [
        [
            'user' => 'Cheke',
            'rank' => 33581,
            'score' => 5,
            'lastAward' => '2024-01-26 00:28:54',
        ],
    ];
}

it('given a game ID and a user name, retrieves metadata about how that user ranks on the given game', function (): void {
    $response = RetroClient::getUserGameRankAndScore(
        username: 'Cheke',
        gameId: 1,
    );

    expect($response)
        ->toBeInstanceOf(UserGameRankAndScoreData::class)
        ->and($response->transformed())
        ->toBe(expectedUserGameRankAndScore());
});

it('given a game ID and a user name, retrieves metadata about how that user ranks on the given game in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserGameRankAndScore(
        username: 'Cheke',
        gameId: 1,
    );

    expect($response)
        ->toBe(expectedUserGameRankAndScore());
});

it('given a game ID and a user name, retrieves metadata about how that user ranks on the given game in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserGameRankAndScore(
        username: 'Cheke',
        gameId: 1,
    );

    expect($response)
        ->toBe(fakeUserGameRankAndScore());
});
