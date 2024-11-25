<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\UserClaimsData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getUserClaims */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeUserClaims(),
    ]);
});

function fakeUserClaims(): array
{
    return [
        [
            'ID' => 13185,
            'User' => 'Jamiras',
            'GameID' => 8991,
            'GameTitle' => 'Double Moon Densetsu',
            'GameIcon' => '/Images/071237.png',
            'ConsoleID' => 7,
            'ConsoleName' => 'NES/Famicom',
            'ClaimType' => 0,
            'SetType' => 0,
            'Status' => 0,
            'Extension' => 0,
            'Special' => 0,
            'Created' => '2024-05-29 23:42:12',
            'DoneTime' => '2024-08-29 23:42:12',
            'Updated' => '2024-05-29 23:42:12',
            'UserIsJrDev' => 0,
            'MinutesLeft' => 15789,
        ],
        [
            'ID' => 12544,
            'User' => 'Jamiras',
            'GameID' => 4064,
            'GameTitle' => 'Block Kuzushi',
            'GameIcon' => '/Images/097454.png',
            'ConsoleID' => 4,
            'ConsoleName' => 'Game Boy',
            'ClaimType' => 0,
            'SetType' => 0,
            'Status' => 1,
            'Extension' => 0,
            'Special' => 0,
            'Created' => '2024-03-25 01:35:10',
            'DoneTime' => '2024-06-07 00:34:52',
            'Updated' => '2024-06-07 00:34:52',
            'UserIsJrDev' => 0,
            'MinutesLeft' => -105117,
        ],
    ];
}

function expectedUserClaims(): array
{
    return [
        [
            'id' => 13185,
            'user' => 'Jamiras',
            'gameId' => 8991,
            'gameTitle' => 'Double Moon Densetsu',
            'gameIcon' => '/Images/071237.png',
            'consoleId' => 7,
            'consoleName' => 'NES/Famicom',
            'claimType' => 0,
            'setType' => 0,
            'status' => 0,
            'extension' => 0,
            'special' => 0,
            'created' => '2024-05-29 23:42:12',
            'doneTime' => '2024-08-29 23:42:12',
            'updated' => '2024-05-29 23:42:12',
            'userIsJrDev' => false,
            'minutesLeft' => 15789,
        ],
        [
            'id' => 12544,
            'user' => 'Jamiras',
            'gameId' => 4064,
            'gameTitle' => 'Block Kuzushi',
            'gameIcon' => '/Images/097454.png',
            'consoleId' => 4,
            'consoleName' => 'Game Boy',
            'claimType' => 0,
            'setType' => 0,
            'status' => 1,
            'extension' => 0,
            'special' => 0,
            'created' => '2024-03-25 01:35:10',
            'doneTime' => '2024-06-07 00:34:52',
            'updated' => '2024-06-07 00:34:52',
            'userIsJrDev' => false,
            'minutesLeft' => -105117,
        ],
    ];
}

it('given a username, retrieves a list of achievement set claims for the user', function (): void {
    $response = RetroClient::getUserClaims(
        username: 'Jamiras',
    );

    expect($response)
        ->toBeInstanceOf(UserClaimsData::class)
        ->and($response->transformed())
        ->toBe(expectedUserClaims());
});

it('given a username, retrieves a list of achievement set claims for the user in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserClaims(
        username: 'Jamiras',
    );

    expect($response)
        ->toBe(expectedUserClaims());
});

it('given a username, retrieves a list of achievement set claims for the user in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserClaims(
        username: 'Jamiras',
    );

    expect($response)
        ->toBe(fakeUserClaims());
});
