<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\Feed\TopTenUserData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasFeed::getTopTenUsers() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeTopTenUsers(),
    ]);
});

function fakeTopTenUsers(): array
{
    return [
        [
            'MaxMilyin',
            424503,
            1707389,
        ],
        [
            'Sarconius',
            379078,
            2736913,
        ],
        [
            'HippopotamusRex',
            372395,
            2501879,
        ],
        [
            'Infernum',
            308366,
            1041351,
        ],
        [
            'Andrey199650',
            296781,
            805194,
        ],
        [
            'ChronoGear',
            289525,
            1539260,
        ],
        [
            'guineu',
            268716,
            777686,
        ],
        [
            'Wendigo',
            253783,
            1475590,
        ],
        [
            'Amir96lx',
            249611,
            796925,
        ],
        [
            'AmericanNinja',
            246602,
            923508,
        ],
    ];
}
function expectedTopTenUsers(): array
{
    return [
        [
            'username' => 'MaxMilyin',
            'totalPoints' => 424503,
            'totalRatioPoints' => 1707389,
        ],
        [
            'username' => 'Sarconius',
            'totalPoints' => 379078,
            'totalRatioPoints' => 2736913,
        ],
        [
            'username' => 'HippopotamusRex',
            'totalPoints' => 372395,
            'totalRatioPoints' => 2501879,
        ],
        [
            'username' => 'Infernum',
            'totalPoints' => 308366,
            'totalRatioPoints' => 1041351,
        ],
        [
            'username' => 'Andrey199650',
            'totalPoints' => 296781,
            'totalRatioPoints' => 805194,
        ],
        [
            'username' => 'ChronoGear',
            'totalPoints' => 289525,
            'totalRatioPoints' => 1539260,
        ],
        [
            'username' => 'guineu',
            'totalPoints' => 268716,
            'totalRatioPoints' => 777686,
        ],
        [
            'username' => 'Wendigo',
            'totalPoints' => 253783,
            'totalRatioPoints' => 1475590,
        ],
        [
            'username' => 'Amir96lx',
            'totalPoints' => 249611,
            'totalRatioPoints' => 796925,
        ],
        [
            'username' => 'AmericanNinja',
            'totalPoints' => 246602,
            'totalRatioPoints' => 923508,
        ],
    ];
}

it('retrieves metadata about the current top ten users on the site', function (): void {
    $response = RetroClient::getTopTenUsers();

    expect($response)
        ->toBeInstanceOf(TopTenUserData::class)
        ->and($response->transformed())
        ->toBe(expectedTopTenUsers());
});

it('retrieves metadata about the current top ten users on the site array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getTopTenUsers();

    expect($response)
        ->toBe(expectedTopTenUsers());
});

it('retrieves metadata about the current top ten users on the site array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getTopTenUsers();

    expect($response)
        ->toBe(fakeTopTenUsers());
});
