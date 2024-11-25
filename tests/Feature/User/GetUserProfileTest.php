<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\UserProfileData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getUserProfile */
beforeEach(function (): void {
    Http::fake(['*' => fakeProfile()]);
});

function fakeProfile(): array
{
    return [
        'User' => 'RAdmin',
        'UserPic' => '/UserPic/RAdmin.png',
        'MemberSince' => '2018-01-07 19:51:53',
        'RichPresenceMsg' => null,
        'LastGameID' => 0,
        'ContribCount' => 0,
        'ContribYield' => 0,
        'TotalPoints' => 0,
        'TotalSoftcorePoints' => 0,
        'TotalTruePoints' => 0,
        'Permissions' => 3,
        'Untracked' => 1,
        'ID' => 60026,
        'UserWallActive' => false,
        'Motto' => 'Send messages to me to get help from the admins!',
    ];
}

function expectedProfile(): array
{
    return [
        'user' => 'RAdmin',
        'userPic' => '/UserPic/RAdmin.png',
        'memberSince' => '2018-01-07 19:51:53',
        'richPresenceMsg' => null,
        'lastGameId' => 0,
        'contribCount' => 0,
        'contribYield' => 0,
        'totalPoints' => 0,
        'totalSoftcorePoints' => 0,
        'totalTruePoints' => 0,
        'permissions' => 3,
        'untracked' => true,
        'id' => 60026,
        'userWallActive' => false,
        'motto' => 'Send messages to me to get help from the admins!',
    ];
}

it('given a username, retrieves the point values associated with the user', function (): void {
    $response = RetroClient::getUserProfile(username: 'RAdmin');

    expect($response)
        ->toBeInstanceOf(UserProfileData::class)
        ->and($response->transformed())
        ->toBe(expectedProfile());
});

it('given a username, retrieves the point values associated with the user in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserProfile(username: 'RAdmin');

    expect($response)
        ->toBe(expectedProfile());
});

it('given a username, retrieves the point values associated with the user in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserProfile(username: 'RAdmin');

    expect($response)
        ->toBe(fakeProfile());
});
