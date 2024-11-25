<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\System\GameData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasSystem::getGameList */
beforeEach(function (): void {
    Http::fake(['*' => fakeGameList()]);
});

function fakeGameList(): array
{
    return [
        [
            'Title' => 'Addams Family, The',
            'ID' => 12,
            'ConsoleID' => 1,
            'ConsoleName' => 'Genesis/Mega Drive',
            'ImageIcon' => '/Images/048141.png',
            'NumAchievements' => 69,
            'NumLeaderboards' => 1,
            'Points' => 450,
            'DateModified' => '2022-07-13 20:05:05',
            'ForumTopicID' => 202,
            'Hashes' => [
                'eba5f964addea18b70336d292a08698d',
            ],
        ],
    ];
}

function expectedGameList(): array
{
    return [
        [
            'title' => 'Addams Family, The',
            'id' => 12,
            'consoleId' => 1,
            'consoleName' => 'Genesis/Mega Drive',
            'imageIcon' => '/Images/048141.png',
            'numAchievements' => 69,
            'numLeaderboards' => 1,
            'points' => 450,
            'dateModified' => '2022-07-13 20:05:05',
            'forumTopicId' => 202,
            'hashes' => [
                'eba5f964addea18b70336d292a08698d',
            ],
        ],
    ];
}

it('retrieves a list of console IDs and their names and cleans properties', function (): void {
    $response = RetroClient::getGameList(
        consoleId: 1,
        shouldRetrieveGameHashes: true,
    );

    expect($response)
        ->toBeInstanceOf(GameData::class)
        ->and($response->transformed())
        ->toBe(expectedGameList());
});

it('retrieves a list of console IDs and their names and cleans properties in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGameList(
        consoleId: 1,
        shouldRetrieveGameHashes: true,
    );

    expect($response)
        ->toBe(expectedGameList());
});

it('retrieves a list of console IDs and their names and cleans properties in array mode with RAW Properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGameList(
        consoleId: 1,
        shouldRetrieveGameHashes: true,
    );

    expect($response)
        ->toBe(fakeGameList());
});
