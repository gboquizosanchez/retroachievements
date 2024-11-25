<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\UserCompletionProgressData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getUserCompletionProgress */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeUserCompletionProgress(),
    ]);
});

function fakeUserCompletionProgress(): array
{
    return [
        'Count' => 62,
        'Total' => 62,
        'Results' => [
            [
                'GameID' => 24140,
                'Title' => 'Pokemon Crystal Version [Subset - Professor Oak Challenge]',
                'ImageIcon' => '/Images/071892.png',
                'ConsoleID' => 6,
                'ConsoleName' => 'Game Boy Color',
                'MaxPossible' => 224,
                'NumAwarded' => 224,
                'NumAwardedHardcore' => 224,
                'MostRecentAwardedDate' => '2024-07-06T23:15:47+00:00',
                'HighestAwardKind' => 'mastered',
                'HighestAwardDate' => '2024-07-06T23:15:47+00:00',
            ],
            [
                'GameID' => 5139,
                'Title' => "Rock n' Roll Racing",
                'ImageIcon' => '/Images/052343.png',
                'ConsoleID' => 5,
                'ConsoleName' => 'Game Boy Advance',
                'MaxPossible' => 33,
                'NumAwarded' => 4,
                'NumAwardedHardcore' => 4,
                'MostRecentAwardedDate' => '2024-07-23T23:31:50+00:00',
                'HighestAwardKind' => null,
                'HighestAwardDate' => null,
            ],
        ],
    ];
}

function expectedUserCompletionProgress(): array
{
    return [
        'count' => 62,
        'total' => 62,
        'results' => [
            [
                'gameId' => 24140,
                'title' => 'Pokemon Crystal Version [Subset - Professor Oak Challenge]',
                'imageIcon' => '/Images/071892.png',
                'consoleId' => 6,
                'consoleName' => 'Game Boy Color',
                'maxPossible' => 224,
                'numAwarded' => 224,
                'numAwardedHardcore' => 224,
                'mostRecentAwardedDate' => '2024-07-06T23:15:47+00:00',
                'highestAwardKind' => 'mastered',
                'highestAwardDate' => '2024-07-06T23:15:47+00:00',
            ],
            [
                'gameId' => 5139,
                'title' => "Rock n' Roll Racing",
                'imageIcon' => '/Images/052343.png',
                'consoleId' => 5,
                'consoleName' => 'Game Boy Advance',
                'maxPossible' => 33,
                'numAwarded' => 4,
                'numAwardedHardcore' => 4,
                'mostRecentAwardedDate' => '2024-07-23T23:31:50+00:00',
                'highestAwardKind' => null,
                'highestAwardDate' => null,
            ],
        ],
    ];
}

it('retrieves completion progress by username', function (): void {
    $response = RetroClient::getUserCompletionProgress(
        username: 'Cheke',
    );

    expect($response)
        ->toBeInstanceOf(UserCompletionProgressData::class)
        ->and($response->transformed())
        ->toBe(expectedUserCompletionProgress());
});

it('retrieves completion progress by username in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserCompletionProgress(
        username: 'Cheke',
    );

    expect($response)
        ->toBe(expectedUserCompletionProgress());
});

it('retrieves completion progress by username in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserCompletionProgress(
        username: 'Cheke',
    );

    expect($response)
        ->toBe(fakeUserCompletionProgress());
});
