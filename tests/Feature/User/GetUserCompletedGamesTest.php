<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\UserCompletedGamesData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getUserCompletedGames */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeUserCompletedGames(),
    ]);
});

function fakeUserCompletedGames(): array
{
    return [
        [
            'GameID' => 19921,
            'Title' => 'Mega Man: Powered Up [Subset - 468 Stages]',
            'ImageIcon' => '/Images/073205.png',
            'ConsoleID' => 41,
            'ConsoleName' => 'PlayStation Portable',
            'MaxPossible' => 480,
            'NumAwarded' => 480,
            'PctWon' => '1.0000',
            'HardcoreMode' => '0',
        ],
        [
            'GameID' => 19921,
            'Title' => 'Mega Man: Powered Up [Subset - 468 Stages]',
            'ImageIcon' => '/Images/073205.png',
            'ConsoleID' => 41,
            'ConsoleName' => 'PlayStation Portable',
            'MaxPossible' => 480,
            'NumAwarded' => 480,
            'PctWon' => '1.0000',
            'HardcoreMode' => '1',
        ],
    ];
}

function expectedUserCompletedGames(): array
{
    return [
        [
            'gameId' => 19921,
            'title' => 'Mega Man: Powered Up [Subset - 468 Stages]',
            'imageIcon' => '/Images/073205.png',
            'consoleID' => '41',
            'consoleName' => 'PlayStation Portable',
            'maxPossible' => 480,
            'numAwarded' => 480,
            'pctWon' => 1,
            'hardcoreMode' => 0,
        ],
        [
            'gameId' => 19921,
            'title' => 'Mega Man: Powered Up [Subset - 468 Stages]',
            'imageIcon' => '/Images/073205.png',
            'consoleID' => '41',
            'consoleName' => 'PlayStation Portable',
            'maxPossible' => 480,
            'numAwarded' => 480,
            'pctWon' => 1,
            'hardcoreMode' => 1,
        ],
    ];
}

it('given a username, returns completion metadata', function (): void {
    $response = RetroClient::getUserCompletedGames(
        username: 'MaxMilyin',
    );

    expect($response)
        ->toBeInstanceOf(UserCompletedGamesData::class)
        ->and($response->transformed())
        ->toBe(expectedUserCompletedGames());
});


it('given a username, returns completion metadata in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserCompletedGames(
        username: 'MaxMilyin',
    );

    expect($response)
        ->toBe(expectedUserCompletedGames());
});

it('given a username, returns completion metadata in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserCompletedGames(
        username: 'MaxMilyin',
    );

    expect($response)
        ->toBe(fakeUserCompletedGames());
});
