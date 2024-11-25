<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\Game\RankAndScoreData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasGame::getGameRankAndScore */
beforeEach(function (): void {
    Http::fake(['*' => fakeGameRankAndScore()]);
});

function fakeGameRankAndScore(): array
{
    return [
        [
            'User' => 'Crazeuh',
            'NumAchievements' => 36,
            'TotalScore' => 305,
            'LastAward' => '2024-06-12 10:26:14',
        ],
    ];
}

function expectedRankAndScore(): array
{
    return [
        [
            'user' => 'Crazeuh',
            'numAchievements' => 36,
            'totalScore' => 305,
            'lastAward' => '2024-06-12 10:26:14',
        ],
    ];
}

it('should retrieve game rank and score', function (): void {
    $response = RetroClient::getGameRankAndScore(gameId: 1, type: 'high-scores');

    expect($response)
        ->toBeInstanceOf(RankAndScoreData::class)
        ->and($response->transformed())
        ->toBe(expectedRankAndScore());
});

it('should retrieve game rank and score with invalid type', function (): void {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Invalid type: invalid. Valid values are: latest-masters or high-scores');

    RetroClient::getGameRankAndScore(gameId: 1, type: 'invalid');
});

it('should retrieve game rank and score in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGameRankAndScore(gameId: 1, type: 'high-scores');

    expect($response)
        ->toBe(expectedRankAndScore());
});

it('should retrieve game rank and score in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGameRankAndScore(gameId: 1, type: 'high-scores');

    expect($response)
        ->toBe(fakeGameRankAndScore());
});
