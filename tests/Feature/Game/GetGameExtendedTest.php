<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\Game\GameExtendedData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasGame::getGameExtended */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeGameExtended(),
    ]);
});

function fakeGameExtended(): array
{
    return [
        'ID' => 1,
        'Title' => 'Sonic the Hedgehog',
        'ConsoleID' => 1,
        'ForumTopicID' => 112,
        'Flags' => null,
        'ImageIcon' => '/Images/085573.png',
        'ImageTitle' => '/Images/054993.png',
        'ImageIngame' => '/Images/000010.png',
        'ImageBoxArt' => '/Images/051872.png',
        'Publisher' => 'Sega',
        'Developer' => 'Sonic Team',
        'Genre' => '2D Platforming',
        'Released' => '1991-06-23',
        'ReleasedAtGranularity' => 'day',
        'IsFinal' => 0,
        'RichPresencePatch' => 'cce60593880d25c97797446ed33eaffb',
        "GuideURL" => null,
        'Updated' => '2024-06-19T19:54:34.000000Z',
        'ConsoleName' => 'Genesis/Mega Drive',
        'ParentGameID' => null,
        'NumDistinctPlayers' => 33506,
        'NumAchievements' => 36,
        'Achievements' => [
            1 => [
                'ID' => 1,
                'NumAwarded' => 13929,
                'NumAwardedHardcore' => 7112,
                'Title' => 'Ring Collector',
                'Description' => 'Collect 100 rings',
                'Points' => 5,
                'TrueRatio' => 7,
                'Author' => 'Scott',
                'DateModified' => '2023-09-30 02:00:49',
                'DateCreated' => '2012-11-02 00:03:12',
                'BadgeName' => '250341',
                'DisplayOrder' => 10,
                'MemAddr' => '241b985197a1369756243b515d5448f2',
                'type' => null,
            ],
        ],
        'Claims' => [
            [
                'User' => 'Scott',
                'SetType' => 0,
                'GameID' => 1,
                'ClaimType' => 0,
                'Created' => '2012-11-02 00:00:00',
                'Expiration' => '2012-11-02 00:00:00',
            ],
        ],
        'NumDistinctPlayersCasual' => 33506,
        'NumDistinctPlayersHardcore' => 33506,
    ];
}

function expectedGameExtended(): array
{
    return [
        'id' => 1,
        'title' => 'Sonic the Hedgehog',
        'consoleId' => 1,
        'forumTopicId' => 112,
        'flags' => null,
        'imageIcon' => '/Images/085573.png',
        'imageTitle' => '/Images/054993.png',
        'imageInGame' => '/Images/000010.png',
        'imageBoxArt' => '/Images/051872.png',
        'publisher' => 'Sega',
        'developer' => 'Sonic Team',
        'genre' => '2D Platforming',
        'released' => '1991-06-23',
        'releasedAtGranularity' => 'day',
        'isFinal' => false,
        'richPresencePatch' => 'cce60593880d25c97797446ed33eaffb',
        'guideUrl' => null,
        'updated' => '2024-06-19T19:54:34.000000Z',
        'consoleName' => 'Genesis/Mega Drive',
        'parentGameId' => null,
        'numDistinctPlayers' => 33506,
        'numAchievements' => 36,
        'achievements' => [
            1 => [
                'id' => 1,
                'numAwarded' => 13929,
                'numAwardedHardcore' => 7112,
                'title' => 'Ring Collector',
                'description' => 'Collect 100 rings',
                'points' => 5,
                'trueRatio' => 7,
                'author' => 'Scott',
                'dateModified' => '2023-09-30 02:00:49',
                'dateCreated' => '2012-11-02 00:03:12',
                'badgeName' => '250341',
                'displayOrder' => 10,
                'memAddr' => '241b985197a1369756243b515d5448f2',
                'type' => null,
            ],
        ],
        'claims' => [
            [
                'user' => 'Scott',
                'setType' => 0,
                'gameId' => 1,
                'claimType' => 0,
                'created' => '2012-11-02 00:00:00',
                'expiration' => '2012-11-02 00:00:00',
            ],
        ],
        'numDistinctPlayersCasual' => 33506,
        'numDistinctPlayersHardcore' => 33506,
    ];
}

it('given a game ID, retrieves extended metadata about the game', function (): void {
    $response = RetroClient::getGameExtended(gameId: 1);

    expect($response)
        ->toBeInstanceOf(GameExtendedData::class)
        ->and($response->transformed())
        ->toBe(expectedGameExtended());
});

it('given a game ID, retrieves extended metadata about the game in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGameExtended(gameId: 1);

    expect($response)
        ->toBe(expectedGameExtended());
});

it('given a game ID, retrieves extended metadata about the game in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGameExtended(gameId: 1);

    expect($response)
        ->toBe(fakeGameExtended());
});
