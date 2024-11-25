<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\Feed\AchievementOfTheWeekData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasEvent::getAchievementOfTheWeek */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeAchievementOfTheWeek(),
    ]);
});

function fakeAchievementOfTheWeek(): array
{
    return [
        'ID' => 307884,
        'Title' => 'Lunar Eclipse',
        'Description' => 'Clear Level-15.',
        'Points' => 1,
        'TrueRatio' => 1,
        'Type' => null,
        'Author' => 'MGNS8M',
        'BadgeName' => '340592',
        'DateCreated' => '2023-04-11 18:11:30',
        'DateModified' => '2023-04-11 18:11:30',
        'Console' => [
            'ID' => 40,
            'Title' => 'Dreamcast',
        ],
        'ForumTopic' => [
            'ID' => 24926,
        ],
        'Game' => [
            'ID' => 3490,
            'Title' => 'Bangai-O',
        ],
        'StartAt' => '2024-06-10T00:00:00.000000Z',
        'TotalPlayers' => 362,
        'Unlocks' => [
            [
                'User' => 'OverlordNader',
                'RAPoints' => 14166,
                'RASoftcorePoints' => 0,
                'DateAwarded' => '2024-06-13T22:21:46.000000Z',
                'HardcoreMode' => 1,
            ],
        ],
        'UnlocksCount' => 1,
        'UnlocksHardcoreCount' => 14166,
    ];
}

function expectedAchievementOfTheWeek(): array
{
    return [
        'id' => 307884,
        'title' => 'Lunar Eclipse',
        'description' => 'Clear Level-15.',
        'points' => 1,
        'trueRatio' => 1,
        'author' => 'MGNS8M',
        'type' => null,
        'badgeName' => '340592',
        'dateCreated' => '2023-04-11 18:11:30',
        'dateModified' => '2023-04-11 18:11:30',
        'console' => [
            'id' => 40,
            'title' => 'Dreamcast',
        ],
        'forumTopic' => [
            'id' => 24926,
        ],
        'game' => [
            'id' => 3490,
            'title' => 'Bangai-O',
        ],
        'startAt' => '2024-06-10T00:00:00.000000Z',
        'totalPlayers' => 362,
        'unlocks' => [
            [
                'user' => 'OverlordNader',
                'raPoints' => 14166,
                'raSoftcorePoints' => 0,
                'dateAwarded' => '2024-06-13T22:21:46.000000Z',
                'hardcoreMode' => true,
            ],
        ],
        'unlocksCount' => 1,
        'unlocksHardcoreCount' => 14166,
    ];
}

it('retrieves metadata about the current achievement of the week and cleans properties', function (): void {
    $response = RetroClient::getAchievementOfTheWeek();

    expect($response)
        ->toBeInstanceOf(AchievementOfTheWeekData::class)
        ->and($response->transformed())
        ->toBe(expectedAchievementOfTheWeek());
});

it('retrieves metadata about the current achievement of the week and cleans properties array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getAchievementOfTheWeek();

    expect($response)
        ->toBe(expectedAchievementOfTheWeek());
});

it('retrieves metadata about the current achievement of the week and cleans properties array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getAchievementOfTheWeek();

    expect($response)
        ->toBe(fakeAchievementOfTheWeek());
});
