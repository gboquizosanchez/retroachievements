<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\Feed\ClaimData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasFeed::getActiveClaims */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeActiveClaims(),
    ]);
});

function fakeActiveClaims(): array
{
    return [
        [
            'ID' => 13352,
            'User' => 'NamcoPlayer9871',
            'GameID' => 2742,
            'GameTitle' => 'Cosmo Gang: The Video',
            'GameIcon' => '/Images/000001.png',
            'ConsoleID' => 3,
            'ConsoleName' => 'SNES/Super Famicom',
            'ClaimType' => 0,
            'SetType' => 0,
            'Status' => 0,
            'Extension' => 0,
            'Special' => 0,
            'Created' => '2024-06-14 20:17:21',
            'DoneTime' => '2024-09-14 20:17:21',
            'Updated' => '2024-06-14 20:17:21',
            'UserIsJrDev' => 0,
            'MinutesLeft' => 132333,
        ], [
            'ID' => 13351,
            'User' => 'Cheatsalot123',
            'GameID' => 14577,
            'GameTitle' => 'Grandia',
            'GameIcon' => '/Images/000001.png',
            'ConsoleID' => 39,
            'ConsoleName' => 'Saturn',
            'ClaimType' => 0,
            'SetType' => 0,
            'Status' => 0,
            'Extension' => 0,
            'Special' => 0,
            'Created' => '2024-06-14 14:03:16',
            'DoneTime' => '2024-09-14 14:03:16',
            'Updated' => '2024-06-14 14:03:16',
            'UserIsJrDev' => 0,
            'MinutesLeft' => 131959,
        ],
    ];
}

function expectedActiveClaims(): array
{
    return [
        [
            'id' => 13352,
            'user' => 'NamcoPlayer9871',
            'gameId' => 2742,
            'gameTitle' => 'Cosmo Gang: The Video',
            'gameIcon' => '/Images/000001.png',
            'consoleId' => 3,
            'consoleName' => 'SNES/Super Famicom',
            'claimType' => 0,
            'setType' => 0,
            'status' => 0,
            'extension' => 0,
            'special' => 0,
            'created' => '2024-06-14 20:17:21',
            'doneTime' => '2024-09-14 20:17:21',
            'updated' => '2024-06-14 20:17:21',
            'userIsJrDev' => false,
            'minutesLeft' => 132333,
        ], [
            'id' => 13351,
            'user' => 'Cheatsalot123',
            'gameId' => 14577,
            'gameTitle' => 'Grandia',
            'gameIcon' => '/Images/000001.png',
            'consoleId' => 39,
            'consoleName' => 'Saturn',
            'claimType' => 0,
            'setType' => 0,
            'status' => 0,
            'extension' => 0,
            'special' => 0,
            'created' => '2024-06-14 14:03:16',
            'doneTime' => '2024-09-14 14:03:16',
            'updated' => '2024-06-14 14:03:16',
            'userIsJrDev' => false,
            'minutesLeft' => 131959,
        ],
    ];
}

it('retrieves metadata about current active claims', function (): void {
    $response = RetroClient::getActiveClaims();

    expect($response)
        ->toBeInstanceOf(ClaimData::class)
        ->and($response->transformed())
        ->toBe(expectedActiveClaims());
});

it('retrieves metadata about current active claims array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response =  RetroClient::getActiveClaims();

    expect($response)
        ->toBe(expectedActiveClaims());
});

it('retrieves metadata about current active claims array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response =  RetroClient::getActiveClaims();

    expect($response)
        ->toBe(fakeActiveClaims());
});
