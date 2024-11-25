<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\Feed\ClaimData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasFeed::getClaims */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeClaims(),
    ]);
});

function fakeClaims(): array
{
    return [
        [
            'ID' => 13334,
            'User' => 'Gloves',
            'GameID' => 29046,
            'GameTitle' => '~Homebrew~ Scrolls of Fire',
            'GameIcon' => '/Images/098479.png',
            'ConsoleID' => 5,
            'ConsoleName' => 'Game Boy Advance',
            'ClaimType' => 0,
            'SetType' => 0,
            'Status' => 1,
            'Extension' => 0,
            'Special' => 0,
            'Created' => '2024-06-12 17:03:41',
            'DoneTime' => '2024-06-14 00:32:30',
            'Updated' => '2024-06-14 00:32:30',
            'UserIsJrDev' => 0,
            'MinutesLeft' => -1366,
        ],
        [
            'ID' => 13329,
            'User' => 'BahamutVoid',
            'GameID' => 1,
            'GameTitle' => 'Sonic the Hedgehog',
            'GameIcon' => '/Images/085573.png',
            'ConsoleID' => 1,
            'ConsoleName' => 'Genesis/Mega Drive',
            'ClaimType' => 0,
            'SetType' => 1,
            'Status' => 1,
            'Extension' => 0,
            'Special' => 0,
            'Created' => '2024-06-12 09:34:21',
            'DoneTime' => '2024-06-12 09:35:15',
            'Updated' => '2024-06-12 09:35:15',
            'UserIsJrDev' => 0,
            'MinutesLeft' => -3704,
        ],
    ];
}

function expectedClaims(): array
{
    return [
        [
            'id' => 13334,
            'user' => 'Gloves',
            'gameId' => 29046,
            'gameTitle' => '~Homebrew~ Scrolls of Fire',
            'gameIcon' => '/Images/098479.png',
            'consoleId' => 5,
            'consoleName' => 'Game Boy Advance',
            'claimType' => 0,
            'setType' => 0,
            'status' => 1,
            'extension' => 0,
            'special' => 0,
            'created' => '2024-06-12 17:03:41',
            'doneTime' => '2024-06-14 00:32:30',
            'updated' => '2024-06-14 00:32:30',
            'userIsJrDev' => false,
            'minutesLeft' => -1366,
        ], [
            'id' => 13329,
            'user' => 'BahamutVoid',
            'gameId' => 1,
            'gameTitle' => 'Sonic the Hedgehog',
            'gameIcon' => '/Images/085573.png',
            'consoleId' => 1,
            'consoleName' => 'Genesis/Mega Drive',
            'claimType' => 0,
            'setType' => 1,
            'status' => 1,
            'extension' => 0,
            'special' => 0,
            'created' => '2024-06-12 09:34:21',
            'doneTime' => '2024-06-12 09:35:15',
            'updated' => '2024-06-12 09:35:15',
            'userIsJrDev' => false,
            'minutesLeft' => -3704,
        ],
    ];
}

it('retrieves metadata about a requested kind of claims', function (): void {
    $response = RetroClient::getClaims();

    expect($response)
        ->toBeInstanceOf(ClaimData::class)
        ->and($response->transformed())
        ->toBe(expectedClaims());
});

it('retrieve metadata about a requested kind of claims with invalid kind', function (): void {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Invalid claim kind: invalid. Valid values are: completed, dropped or expired');

    RetroClient::getClaims('invalid');
});

it('retrieves metadata about a requested kind of claims array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response =  RetroClient::getClaims();

    expect($response)
        ->toBe(expectedClaims());
});

it('retrieves metadata about a requested kind of claims array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response =  RetroClient::getClaims();

    expect($response)
        ->toBe(fakeClaims());
});
