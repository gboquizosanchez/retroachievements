<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\UserRecentAchievementsData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getUserRecentAchievements */
beforeEach(function (): void {
    Http::fake(['*' => fakeUserRecentAchievements()]);
});

function fakeUserRecentAchievements(): array
{
    return [
        [
            'Date' => '2022-10-05 04:04:03',
            'HardcoreMode' => 1,
            'AchievementID' => 225849,
            'Title' => 'We Love You',
            'Description' => 'Collect all objects in the Fans category',
            'BadgeName' => '250082',
            'Points' => 10,
            'TrueRatio' => 57,
            'Type' => null,
            'Author' => 'Gollawiz',
            'GameTitle' => 'We Love Katamari',
            'GameIcon' => '/Images/057479.png',
            'GameID' => 2672,
            'ConsoleName' => 'PlayStation 2',
            'BadgeURL' => '/Badge/250082.png',
            'GameURL' => '/game/2672',
        ],
    ];
}

function expectedUserRecentAchievements(): array
{
    return [
        [
            'date' => '2022-10-05 04:04:03',
            'hardcoreMode' => true,
            'achievementId' => 225849,
            'title' => 'We Love You',
            'description' => 'Collect all objects in the Fans category',
            'badgeName' => '250082',
            'points' => 10,
            'trueRatio' => 57,
            'type' => null,
            'author' => 'Gollawiz',
            'gameTitle' => 'We Love Katamari',
            'gameIcon' => '/Images/057479.png',
            'gameId' => 2672,
            'consoleName' => 'PlayStation 2',
            'badgeUrl' => '/Badge/250082.png',
            'gameUrl' => '/game/2672',
        ],
    ];
}

it('retrieves a list of recently-earned user achievements', function (): void {
    $response = RetroClient::getUserRecentAchievements(username: 'xelnia');

    expect($response)
        ->toBeInstanceOf(UserRecentAchievementsData::class)
        ->and($response->transformed())
        ->toBe(expectedUserRecentAchievements());
});

it('retrieves a list of recently-earned user achievements in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserRecentAchievements(username: 'xelnia');

    expect($response)
        ->toBe(expectedUserRecentAchievements());
});

it('retrieves a list of recently-earned user achievements in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserRecentAchievements(username: 'xelnia');

    expect($response)
        ->toBe(fakeUserRecentAchievements());
});
