<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\DateUserAchievementsData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getAchievementsEarnedBetween */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeAchievementsEarnedBetween(),
    ]);
});

function fakeAchievementsEarnedBetween(): array
{
    return [
        [
            'Date' => '2021-12-20 03:40:10',
            'HardcoreMode' => 1,
            'AchievementID' => 121789,
            'Title' => 'Barrel Jump Double',
            'Description' => 'Jump two barrels (or a barrel and a flame) at once and collect 300 points (3 Lives setting)',
            'BadgeName' => '133124',
            'Points' => 5,
            'TrueRatio' => 5,
            'Type' => null,
            'Author' => 'KloggMonkey',
            'GameTitle' => 'Donkey Kong',
            'GameIcon' => '/Images/035636.png',
            'GameID' => 11943,
            'ConsoleName' => 'Arcade',
            'CumulScore' => 5,
            'BadgeURL' => '/Badge/133124.png',
            'GameURL' => '/game/11943',
        ],
    ];
}

function expectedAchievementsEarnedBetween(): array
{
    return [
        [
            'date' => '2021-12-20 03:40:10',
            'hardcoreMode' => true,
            'achievementId' => 121789,
            'title' => 'Barrel Jump Double',
            'description' => 'Jump two barrels (or a barrel and a flame) at once and collect 300 points (3 Lives setting)',
            'badgeName' => '133124',
            'points' => 5,
            'trueRatio' => 5,
            'type' => null,
            'author' => 'KloggMonkey',
            'gameTitle' => 'Donkey Kong',
            'gameIcon' => '/Images/035636.png',
            'gameId' => 11943,
            'consoleName' => 'Arcade',
            'cumulScore' => 5,
            'badgeUrl' => '/Badge/133124.png',
            'gameUrl' => '/game/11943',
        ],
    ];
}


it('retrieves a list of user achievements earned between a set of dates', function (): void {
    $response = RetroClient::getAchievementsEarnedBetween(
        username: 'xelnia',
        fromDate: new DateTime('2021-01-01'),
        toDate: new DateTime('2021-12-31'),
    );

    expect($response)
        ->toBeInstanceOf(DateUserAchievementsData::class)
        ->and($response->transformed())
        ->toBe(expectedAchievementsEarnedBetween());
});

it('retrieves a list of user achievements earned between a set of dates in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getAchievementsEarnedBetween(
        username: 'xelnia',
        fromDate: new DateTime('2021-01-01'),
        toDate: new DateTime('2021-12-31'),
    );

    expect($response)
        ->toBe(expectedAchievementsEarnedBetween());
});

it('retrieves a list of user achievements earned between a set of dates in array mode with RAW Properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getAchievementsEarnedBetween(
        username: 'xelnia',
        fromDate: new DateTime('2021-01-01'),
        toDate: new DateTime('2021-12-31'),
    );

    expect($response)
        ->toBe(fakeAchievementsEarnedBetween());
});
