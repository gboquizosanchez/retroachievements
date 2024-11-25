<?php

declare(strict_types=1);

use RetroAchievements\Data\AuthData;
use RetroAchievements\Exceptions\UnauthorizedException;
use RetroAchievements\Models\RetroAchievements;

it('should be the config in file', function (): void {
    expect(config('retro-achievements'))
        ->toBe([
            'base_url' => 'https://retroachievements.org/API',
            'credentials' => [
                'username' => 'myUsername',
                'web_api_key' => 'myWebApiKey',
            ],
        ])
        ->toBeArray();
});

it('should be unauthorized', function (): void {
    $client = new RetroAchievements(new AuthData(
        username: 'invalid-username',
        webApiKey: 'invalid-api',
    ));

    $client->getGameList(1);
})->throws(UnauthorizedException::class);
