<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\AuthData;
use RetroAchievements\Enums\AchievementDistributionFlags;
use RetroAchievements\Models\RetroAchievements;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasGame::getAchievementDistribution */
beforeEach(function (): void {
    $auth = new AuthData(
        username: 'mockUsername',
        webApiKey: 'mockWebApiKey',
    );

    $this->retro = new RetroAchievements($auth);

    Http::fake([
        '*' => [
            '1' => 20,
            '2' => 10,
            '3' => 8,
            '4' => 4,
            '5' => 1,
        ],
    ]);
});

it('given a game ID, retrieves the achievement distribution associated with the game', function (): void {
    $response = RetroClient::getAchievementDistribution(gameId: 14_402);

    $url = $this->retro->url('API_GetAchievementDistribution.php', [
        'i' => 14_402,
    ]);

    expect($response)
        ->toBe([
            '1' => 20,
            '2' => 10,
            '3' => 8,
            '4' => 4,
            '5' => 1,
        ])
        ->and($url)
        ->toContain('i=14402')
        ->not()
        ->toContain('f=')
        ->not()
        ->toContain('h=');
});

it('given flags, successfully attaches the option to the call', function (): void {
    $response = RetroClient::getAchievementDistribution(
        gameId: 14_402,
        flags: AchievementDistributionFlags::UnofficialAchievements,
    );

    $url = $this->retro->url('API_GetAchievementDistribution.php', [
        'i' => 14_402,
        'f' => AchievementDistributionFlags::UnofficialAchievements->value,
    ]);

    expect($response)
        ->toBe([
            '1' => 20,
            '2' => 10,
            '3' => 8,
            '4' => 4,
            '5' => 1,
        ])
        ->and($url)
        ->toContain('i=14402')
        ->toContain('f=' . AchievementDistributionFlags::UnofficialAchievements->value)
        ->not()
        ->toContain('h=');
});

it('given a truthy hardcore value, successfully attaches the option to the call', function (): void {
    $response = RetroClient::getAchievementDistribution(
        gameId: 14_402,
        hardcore: true,
    );

    $url = $this->retro->url('API_GetAchievementDistribution.php', [
        'i' => 14_402,
        'h' => 1,
    ]);

    expect($response)
        ->toBe([
            '1' => 20,
            '2' => 10,
            '3' => 8,
            '4' => 4,
            '5' => 1,
        ])
        ->and($url)
        ->toContain('i=14402')
        ->not()
        ->toContain('f=')
        ->toContain('h=1');
});

it('given a falsy hardcore value, successfully attaches the option to the call', function (): void {
    $response = RetroClient::getAchievementDistribution(
        gameId: 14_402,
        hardcore: false,
    );

    $url = $this->retro->url('API_GetAchievementDistribution.php', [
        'i' => 14_402,
        'h' => 0,
    ]);

    expect($response)
        ->toBe([
            '1' => 20,
            '2' => 10,
            '3' => 8,
            '4' => 4,
            '5' => 1,
        ])
        ->and($url)
        ->toContain('i=14402')
        ->not()
        ->toContain('f=')
        ->toContain('h=0');
});
