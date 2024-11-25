<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\Feed\RecentTicketData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasFeed::getRecentGameAwards */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRecentGameAwards(),
    ]);
});

function fakeRecentGameAwards(): array
{
    return [
        'Count' => 1,
        'Total' => 371335,
        'Results' => [
            [
                'User' => 'DeanXP',
                'AwardKind' => 'mastered',
                'AwardDate' => '2024-06-13T23:57:05+00:00',
                'GameID' => 1555,
                'GameTitle' => 'Bad Street Brawler',
                'ConsoleID' => 7,
                'ConsoleName' => 'NES/Famicom',
            ],[
                'User' => 'CuddleBugs',
                'AwardKind' => 'beaten-hardcore',
                'AwardDate' => '2024-06-14T22:36:42+00:00',
                'GameID' => 2251,
                'GameTitle' => 'Mega Man II',
                'ConsoleID' => 4,
                'ConsoleName' => 'Game Boy',
            ],
        ],
    ];
}

function expectedRecentGameAwards(): array
{
    return [
        'count' => 1,
        'total' => 371335,
        'results' => [[
            'user' => 'DeanXP',
            'awardKind' => 'mastered',
            'awardDate' => '2024-06-13T23:57:05+00:00',
            'gameId' => 1555,
            'gameTitle' => 'Bad Street Brawler',
            'consoleId' => 7,
            'consoleName' => 'NES/Famicom',
        ],[
            'user' => 'CuddleBugs',
            'awardKind' => 'beaten-hardcore',
            'awardDate' => '2024-06-14T22:36:42+00:00',
            'gameId' => 2251,
            'gameTitle' => 'Mega Man II',
            'consoleId' => 4,
            'consoleName' => 'Game Boy',
        ]],
    ];
}

it('retrieves metadata about all recently-earned game awards on the site', function (): void {
    $response = RetroClient::getRecentGameAwards();

    expect($response)
        ->toBeInstanceOf(RecentTicketData::class)
        ->and($response->transformed())
        ->toBe(expectedRecentGameAwards());
});

it('retrieves metadata about all recently-earned game awards on the site array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getRecentGameAwards();

    expect($response)
        ->toBe(expectedRecentGameAwards());
});

it('retrieves metadata about all recently-earned game awards on the site array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getRecentGameAwards();

    expect($response)
        ->toBe(fakeRecentGameAwards());
});
