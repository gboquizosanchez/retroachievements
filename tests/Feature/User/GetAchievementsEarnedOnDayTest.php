<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\DateUserAchievementsData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getAchievementsEarnedOnDay */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeAchievementsEarnedOnDay(),
    ]);
});

function fakeAchievementsEarnedOnDay(): array
{
    return [
        [
            'Date' => '2022-10-12 06:46:51',
            'HardcoreMode' => 1,
            'AchievementID' => 173362,
            'Title' => 'Your Katamari is Worth $10',
            'Description' => 'Collect all objects in the Antique Category.',
            'BadgeName' => '193803',
            'Points' => 10,
            'TrueRatio' => 21,
            'Type' => null,
            'Author' => 'blendedsea',
            'GameTitle' => 'Me & My Katamari',
            'GameIcon' => '/Images/047357.png',
            'GameID' => 3571,
            'ConsoleName' => 'PlayStation Portable',
            'CumulScore' => 10,
            'BadgeURL' => '/Badge/193803.png',
            'GameURL' => '/game/3571',
        ],
    ];
}

function expectedAchievementsEarnedOnDay(): array
{
    return [
        [
            'date' => '2022-10-12 06:46:51',
            'hardcoreMode' => true,
            'achievementId' => 173362,
            'title' => 'Your Katamari is Worth $10',
            'description' => 'Collect all objects in the Antique Category.',
            'badgeName' => '193803',
            'points' => 10,
            'trueRatio' => 21,
            'type' => null,
            'author' => 'blendedsea',
            'gameTitle' => 'Me & My Katamari',
            'gameIcon' => '/Images/047357.png',
            'gameId' => 3571,
            'consoleName' => 'PlayStation Portable',
            'cumulScore' => 10,
            'badgeUrl' => '/Badge/193803.png',
            'gameUrl' => '/game/3571',
        ],
    ];
}

it('retrieves a list of user achievements earned on a specified date', function (): void {
    $response = RetroClient::getAchievementsEarnedOnDay(
        username: 'xelnia',
        onDate: new DateTime('2022-10-12'),
    );

    expect($response)
        ->toBeInstanceOf(DateUserAchievementsData::class)
        ->and($response->transformed())
        ->toBe(expectedAchievementsEarnedOnDay());
});

it('retrieves a list of user achievements earned on a specified date in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getAchievementsEarnedOnDay(
        username: 'xelnia',
        onDate: new DateTime('2022-10-12'),
    );

    expect($response)
        ->toBe(expectedAchievementsEarnedOnDay());
});

it('retrieves a list of user achievements earned on a specified date in array mode with RAW Properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getAchievementsEarnedOnDay(
        username: 'xelnia',
        onDate: new DateTime('2022-10-12'),
    );

    expect($response)
        ->toBe(fakeAchievementsEarnedOnDay());
});
