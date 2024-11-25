<?php

declare(strict_types=1);

/** @see \RetroAchievements\Concerns\HasGame::getGameHashes */
use RetroAchievements\Data\Game\GameHashesData;
use RetroAchievements\RetroClient;

beforeEach(function (): void {
    Http::fake([
        '*' => fakeGameHashes(),
    ]);
});

function fakeGameHashes(): array
{
    return [
        'Results' => [
            [
                'MD5' => '1b1d9ac862c387367e904036114c4825',
                'Name' => 'Sonic The Hedgehog (USA, Europe) (Ru) (NewGame).md',
                'Labels' => ['nointro', 'rapatches'],
                'PatchUrl' => 'https://github.com/RetroAchievements/RAPatches/raw/main/MD/Translation/Russian/1-Sonic1-Russian.zip',
            ],
            [
                'MD5' => '1bc674be034e43c96b86487ac69d9293',
                'Name' => 'Sonic The Hedgehog (USA, Europe).md',
                'Labels' => ['nointro'],
                'PatchUrl' => null,
            ],
        ],
    ];
}

function expectedGameHashes(): array
{
    return [
        'results' => [
            [
                'md5' => '1b1d9ac862c387367e904036114c4825',
                'name' => 'Sonic The Hedgehog (USA, Europe) (Ru) (NewGame).md',
                'labels' => ['nointro', 'rapatches'],
                'patchUrl' => 'https://github.com/RetroAchievements/RAPatches/raw/main/MD/Translation/Russian/1-Sonic1-Russian.zip',
            ],
            [
                'md5' => '1bc674be034e43c96b86487ac69d9293',
                'name' => 'Sonic The Hedgehog (USA, Europe).md',
                'labels' => ['nointro'],
                'patchUrl' => null,
            ],
        ],
    ];
}

it('should retrieve game hashes', function (): void {
    $response = RetroClient::getGameHashes(gameId: 1);

    expect($response)
        ->toBeInstanceOf(GameHashesData::class)
        ->and($response->transformed())
        ->toBe(expectedGameHashes());
});

it('should retrieve game hashes in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGameHashes(gameId: 1);

    expect($response)
        ->toBe(expectedGameHashes());
});

it('should retrieve game hashes in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGameHashes(gameId: 1);

    expect($response)
        ->toBe(fakeGameHashes());
});
