<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\UserPointsData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getUserPoints */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeUserPoints(),
    ]);
});

function fakeUserPoints(): array
{
    return [
        'Points' => 9587,
        'SoftcorePoints' => 0,
    ];
}

function expectedUserPoints(): array
{
    return [
        'points' => 9587,
        'softcorePoints' => 0,
    ];
}

it('given a username, retrieves the point values associated with the user', function (): void {
    $response = RetroClient::getUserPoints(
        username: 'Cheke',
    );

    expect($response)
        ->toBeInstanceOf(UserPointsData::class)
        ->and($response->transformed())
        ->toBe(expectedUserPoints());
});

it('given a username, retrieves the point values associated with the user in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserPoints(
        username: 'Cheke',
    );

    expect($response)
        ->toBe(expectedUserPoints());
});


it('given a username, retrieves the point values associated with the user in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserPoints(
        username: 'Cheke',
    );

    expect($response)
        ->toBe(fakeUserPoints());
});
