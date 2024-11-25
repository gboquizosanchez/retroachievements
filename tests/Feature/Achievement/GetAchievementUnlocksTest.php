<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\Achievement\AchievementUnlocksData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasAchievement::getAchievementUnlocks */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeAchievementUnlocks(),
    ]);
});

function fakeAchievementUnlocks(): array
{
    return [
        'Achievement' => [
            'ID' => 1,
            'Title' => 'Ring Collector',
            'Description' => 'Collect 100 Rings!',
            'Points' => 5,
            'TrueRatio' => 7,
            'Author' => 'Scott',
            'DateCreated' => '2012-11-02 00:03:12',
            'DateModified' => '2022-06-11 16:52:35',
            'Type' => 'progression',
        ],
        'Console' => [
            'ID' => 1,
            'Title' => 'Genesis/Mega Drive',
        ],
        'Game' => [
            'ID' => 1,
            'Title' => 'Sonic the Hedgehog',
        ],
        'UnlocksCount' => 13_825,
        'UnlocksHardcoreCount' => 7051,
        'TotalPlayers' => 33_236,
        'Unlocks' => [
            [
                'User' => 'Trust20',
                'RAPoints' => 348,
                'RASoftcorePoints' => 636,
                'DateAwarded' => '2024-06-11T21:22:03.000000Z1',
                'HardcoreMode' => 1,
            ],
        ],
    ];
}

function expectedAchievementUnlocks(): array
{
    return [
        'achievement' => [
            'id' => 1,
            'title' => 'Ring Collector',
            'description' => 'Collect 100 Rings!',
            'points' => 5,
            'trueRatio' => 7,
            'author' => 'Scott',
            'dateCreated' => '2012-11-02 00:03:12',
            'dateModified' => '2022-06-11 16:52:35',
            'type' => 'progression',
        ],
        'console' => [
            'id' => 1,
            'title' => 'Genesis/Mega Drive',
        ],
        'game' => [
            'id' => 1,
            'title' => 'Sonic the Hedgehog',
        ],
        'unlocksCount' => 13825,
        'unlocksHardcoreCount' => 7051,
        'totalPlayers' => 33236,
        'unlocks' => [
            [
                'user' => 'Trust20',
                'raPoints' => 348,
                'raSoftcorePoints' => 636,
                'dateAwarded' => '2024-06-11T21:22:03.000000Z1',
                'hardcoreMode' => true,
            ],
        ],
    ];
}

it('retrieves metadata about unlocks for a target achievement DTO mode', function (): void {
    $response = RetroClient::getAchievementUnlocks(achievementId: 10_000);

    expect($response)
        ->toBeInstanceOf(AchievementUnlocksData::class)
        ->and($response->transformed())
        ->toBe(expectedAchievementUnlocks());
});

it('retrieves metadata about unlocks for a target achievement array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getAchievementUnlocks(achievementId: 1);

    expect($response)
        ->toBe(expectedAchievementUnlocks());
});

it('retrieves metadata about unlocks for a target achievement array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getAchievementUnlocks(achievementId: 1);

    expect($response)
        ->toBe(fakeAchievementUnlocks());
});
