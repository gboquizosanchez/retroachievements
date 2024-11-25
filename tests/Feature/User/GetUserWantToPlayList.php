<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\UserWantToPlayData;
use RetroAchievements\Data\User\UserWantToPlayListData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getUserWantToPlayList */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeUserWantToPlayList(),
    ]);
});

function fakeUserWantToPlayList(): array
{
    return [
        'Total' => 2,
        'Count' => 2,
        'Results' => [
            [
                'ID' => 504,
                'Title' => 'Super Mario Land',
                'ImageIcon' => '/Images/078873.png',
                'ConsoleID' => 4,
                'ConsoleName' => 'Game Boy',
                'PointsTotal' => 368,
                'AchievementsPublished' => 36,
            ],
            [
                'ID' => 7009,
                'Title' => 'R-Type',
                'ImageIcon' => '/Images/064445.png',
                'ConsoleID' => 4,
                'ConsoleName' => 'Game Boy',
                'PointsTotal' => 182,
                'AchievementsPublished' => 17,
            ],
        ],
    ];
}

function expectedUserWantToPlayList(): array
{
    return [
        'total' => 2,
        'count' => 2,
        'results' => [
            [
                'id' => 504,
                'title' => 'Super Mario Land',
                'imageIcon' => '/Images/078873.png',
                'consoleId' => 4,
                'consoleName' => 'Game Boy',
                'pointsTotal' => 368,
                'achievementsPublished' => 36,
            ],
            [
                'id' => 7009,
                'title' => 'R-Type',
                'imageIcon' => '/Images/064445.png',
                'consoleId' => 4,
                'consoleName' => 'Game Boy',
                'pointsTotal' => 182,
                'achievementsPublished' => 17,
            ],
        ],
    ];
}

it('retrieves a list of a given user\'s games they want to play', function (): void {
    $response = RetroClient::getUserWantToPlayList(
        username: 'Cheke',
    );

    expect($response)
        ->toBeInstanceOf(UserWantToPlayListData::class)
        ->and($response->transformed())
        ->toBe(expectedUserWantToPlayList());
});

it('retrieves a list of a given user\'s games they want to play in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserWantToPlayList(
        username: 'Cheke',
    );

    expect($response)
        ->toBe(expectedUserWantToPlayList());
});

it('retrieves a list of a given user\'s games they want to play in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserWantToPlayList(
        username: 'Cheke',
    );

    expect($response)
        ->toBe(fakeUserWantToPlayList());
});
