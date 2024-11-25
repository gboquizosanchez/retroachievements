<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\Game\GameData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasGame::getGame */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeGame(),
    ]);
});

function fakeGame(): array
{
    return [
        'Title' => 'Sonic the Hedgehog',
        'GameTitle' => 'Sonic the Hedgehog',
        'ConsoleID' => 1,
        'ConsoleName' => 'Genesis/Mega Drive',
        'Console' => 'Genesis/Mega Drive',
        'ForumTopicID' => 112,
        'Flags' => 0,
        'GameIcon' => '/Images/085573.png',
        'ImageIcon' => '/Images/085573.png',
        'ImageTitle' => '/Images/054993.png',
        'ImageIngame' => '/Images/000010.png',
        'ImageBoxArt' => '/Images/051872.png',
        'Publisher' => 'Sega',
        'Developer' => 'Sonic Team',
        'Genre' => '2D Platforming',
        'Released' => '1991-06-23',
        'ReleasedAtGranularity' => 'day',
    ];
}

function expectedGame(): array
{
    return [
        'title' => 'Sonic the Hedgehog',
        'gameTitle' => 'Sonic the Hedgehog',
        'consoleId' => 1,
        'consoleName' => 'Genesis/Mega Drive',
        'console' => 'Genesis/Mega Drive',
        'forumTopicId' => 112,
        'flags' => 0,
        'gameIcon' => '/Images/085573.png',
        'imageIcon' => '/Images/085573.png',
        'imageTitle' => '/Images/054993.png',
        'imageInGame' => '/Images/000010.png',
        'imageBoxArt' => '/Images/051872.png',
        'publisher' => 'Sega',
        'developer' => 'Sonic Team',
        'genre' => '2D Platforming',
        'released' => '1991-06-23',
        'releasedAtGranularity' => 'day',
    ];
}

it('given a game ID, retrieves basic metadata about the game', function (): void {
    $response = RetroClient::getGame(gameId: 1);

    expect($response)
        ->toBeInstanceOf(GameData::class)
        ->and($response->transformed())
        ->toBe(expectedGame());
});

it('given a game ID, retrieves basic metadata about the game in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGame(gameId: 1);

    expect($response)
        ->toBe(expectedGame());
});

it('given a game ID, retrieves basic metadata about the game in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGame(gameId: 3000);

    expect($response)
        ->toBe(fakeGame());
});
