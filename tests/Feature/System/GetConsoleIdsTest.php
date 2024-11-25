<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\System\SystemData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasSystem::getConsoleIds */
beforeEach(function (): void {
    Http::fake(['*' => fakeConsoleIds()]);
});

function fakeConsoleIds(): array
{
    return [
        [
            'ID' => 1,
            'Name' => 'Genesis/Mega Drive',
            'IconURL' => 'https://static.retroachievements.org/assets/images/system/md.png',
            'Active' => true,
            'IsGameSystem' => true,
        ],
        [
            'ID' => 2,
            'Name' => 'Nintendo 64',
            'IconURL' => 'https://static.retroachievements.org/assets/images/system/n64.png',
            'Active' => true,
            'IsGameSystem' => true,
        ],
        [
            'ID' => 3,
            'Name' => 'SNES/Super Famicom',
            'IconURL' => 'https://static.retroachievements.org/assets/images/system/snes.png',
            'Active' => true,
            'IsGameSystem' => true,
        ],
    ];
}

function expectedConsoleIds(): array
{
    return [
        [
            'id' => 1,
            'name' => 'Genesis/Mega Drive',
            'iconUrl' => 'https://static.retroachievements.org/assets/images/system/md.png',
            'active' => true,
            'isGameSystem' => true,
        ],
        [
            'id' => 2,
            'name' => 'Nintendo 64',
            'iconUrl' => 'https://static.retroachievements.org/assets/images/system/n64.png',
            'active' => true,
            'isGameSystem' => true,
        ],
        [
            'id' => 3,
            'name' => 'SNES/Super Famicom',
            'iconUrl' => 'https://static.retroachievements.org/assets/images/system/snes.png',
            'active' => true,
            'isGameSystem' => true,
        ],
    ];
}

it('retrieves a list of console IDs and their names and cleans properties', function (): void {
    $response = RetroClient::getConsoleIds();

    expect($response)
        ->toBeInstanceOf(SystemData::class)
        ->and($response->transformed())
        ->toBe(expectedConsoleIds());
});

it('retrieves a list of console IDs and their names and cleans properties in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getConsoleIds();

    expect($response)
        ->toBe(expectedConsoleIds());
});

it('retrieves a list of console IDs and their names and cleans properties in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getConsoleIds();

    expect($response)
        ->toBe(fakeConsoleIds());
});
