<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\UserProgressData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getUserProgress */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeUserProgress(),
    ]);
});

function fakeUserProgress(): array
{
    return [
        1 => [
            'NumPossibleAchievements' => 36,
            'PossibleScore' => 305,
            'NumAchieved' => 24,
            'ScoreAchieved' => 255,
            'NumAchievedHardcore' => 24,
            'ScoreAchievedHardcore' => 255,
        ],
        2 => [
            'NumPossibleAchievements' => 21,
            'PossibleScore' => 295,
            'NumAchieved' => 21,
            'ScoreAchieved' => 295,
            'NumAchievedHardcore' => 21,
            'ScoreAchievedHardcore' => 295,
        ],
        3 => [
            'NumPossibleAchievements' => 23,
            'PossibleScore' => 335,
            'NumAchieved' => 23,
            'ScoreAchieved' => 335,
            'NumAchievedHardcore' => 23,
            'ScoreAchievedHardcore' => 335,
        ],
    ];
}

function expectedUserProgress(): array
{
    return [
        1 => [
            'numPossibleAchievements' => 36,
            'possibleScore' => 305,
            'numAchieved' => 24,
            'scoreAchieved' => 255,
            'numAchievedHardcore' => 24,
            'scoreAchievedHardcore' => 255,
        ],
        2 => [
            'numPossibleAchievements' => 21,
            'possibleScore' => 295,
            'numAchieved' => 21,
            'scoreAchieved' => 295,
            'numAchievedHardcore' => 21,
            'scoreAchievedHardcore' => 295,
        ],
        3 => [
            'numPossibleAchievements' => 23,
            'possibleScore' => 335,
            'numAchieved' => 23,
            'scoreAchieved' => 335,
            'numAchievedHardcore' => 23,
            'scoreAchievedHardcore' => 335,
        ],
    ];
}

it('retrieves a map of a user\'s progress by game IDs', function (): void {
    $response = RetroClient::getUserProgress(
        username: 'MaxMilyin',
        gameIds: [1, 2, 3],
    );

    expect($response)
        ->toBeInstanceOf(UserProgressData::class)
        ->and($response->transformed())
        ->toBe(expectedUserProgress());
});

it('retrieves an array of a user\'s progress by game IDs in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserProgress(
        username: 'MaxMilyin',
        gameIds: [1, 2, 3],
    );

    expect($response)
        ->toBe(expectedUserProgress());
});

it('retrieves an array of a user\'s progress by game IDs in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserProgress(
        username: 'MaxMilyin',
        gameIds: [1, 2, 3],
    );

    expect($response)
        ->toBe(fakeUserProgress());
});
