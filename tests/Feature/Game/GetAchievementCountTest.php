<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\Game\AchievementCountData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasGame::getAchievementCount */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeAchievementCount(),
    ]);
});

function fakeAchievementCount(): array
{
    return [
        'GameID' => 1,
        'AchievementIDs' => [1, 2, 3],
    ];
}

function expectedAchievementCount(): array
{
    return [
        'gameId' => 1,
        'achievementIds' => [1, 2, 3],
    ];
}

it('should retrieve achievement count', function (): void {
    $response = RetroClient::getAchievementCount(gameId: 1);

    expect($response)
        ->toBeInstanceOf(AchievementCountData::class)
        ->and($response->transformed())
        ->toBe(expectedAchievementCount());
});

it('should retrieve achievement count in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getAchievementCount(gameId: 1);

    expect($response)
        ->toBe(expectedAchievementCount());
});

it('should retrieve achievement count in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getAchievementCount(gameId: 1);

    expect($response)
        ->toBe(fakeAchievementCount());
});
