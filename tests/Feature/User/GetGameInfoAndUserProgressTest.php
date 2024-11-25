<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\GameInfoAndUserProgressData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getGameInfoAndUserProgress */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeGameInfoAndUserProgress(),
    ]);
});

function fakeGameInfoAndUserProgress(): array
{
    return [
        'ID' => 14402,
        'Title' => 'Dragster',
        'ConsoleID' => 25,
        'ForumTopicID' => 9145,
        'Flags' => 0,
        'ImageIcon' => '/Images/072365.png',
        'ImageTitle' => '/Images/026366.png',
        'ImageIngame' => '/Images/026367.png',
        'ImageBoxArt' => '/Images/066952.png',
        'Publisher' => 'Activision',
        'Developer' => 'David Crane',
        'Genre' => 'Racing',
        'Released' => '1980',
        'ReleasedAtGranularity' => 'day',
        'IsFinal' => 0,
        'RichPresencePatch' => '2b92fa1bf9635c303b3b7f8feea3ed3c',
        'players_total' => 759,
        'achievements_published' => 15,
        'points_total' => 219,
        'GuideURL' => null,
        'ConsoleName' => 'Atari 2600',
        'NumDistinctPlayers' => 759,
        'ParentGameID' => null,
        'NumAchievements' => 15,
        'Achievements' => [
            79434 => [
                'ID' => 79434,
                'NumAwarded' => 565,
                'NumAwardedHardcore' => 421,
                'Title' => 'Novice Dragster Driver 1',
                'Description' => 'Complete your very first race in game 1.',
                'Points' => 1,
                'TrueRatio' => 1,
                'Author' => 'Boldewin',
                'DateModified' => '2019-08-01 19:03:46',
                'DateCreated' => '2019-07-31 18:49:57',
                'BadgeName' => '85541',
                'DisplayOrder' => 0,
                'MemAddr' => 'f5c41fa0b5fa0d5fbb8a74c598f18582',
                'type' => null,
                'DateEarnedHardcore' => '2022-08-31 08:48:26',
                'DateEarned' => '2022-08-31 08:48:26',
            ],
        ],
        'NumAwardedToUser' => 10,
        'NumAwardedToUserHardcore' => 10,
        'NumDistinctPlayersCasual' => 759,
        'NumDistinctPlayersHardcore' => 759,
        'UserCompletion' => '66.67%',
        'UserCompletionHardcore' => '66.67%',
    ];
}

function expectedGameInfoAndUserProgress(): array
{
    return [
        'achievements' => [
            79434 => [
                'dateEarned' => '2022-08-31 08:48:26',
                'dateEarnedHardcore' => '2022-08-31 08:48:26',
                'id' => 79434,
                'numAwarded' => 565,
                'numAwardedHardcore' => 421,
                'title' => 'Novice Dragster Driver 1',
                'description' => 'Complete your very first race in game 1.',
                'points' => 1,
                'trueRatio' => 1,
                'author' => 'Boldewin',
                'dateModified' => '2019-08-01 19:03:46',
                'dateCreated' => '2019-07-31 18:49:57',
                'badgeName' => '85541',
                'displayOrder' => 0,
                'memAddr' => 'f5c41fa0b5fa0d5fbb8a74c598f18582',
                'type' => null,
            ],
        ],
        'numAwardedToUser' => 10,
        'numAwardedToUserHardcore' => 10,
        'userCompletion' => '66.67%',
        'userCompletionHardcore' => '66.67%',
        'highestAwardKind' => null,
        'playersTotal' => 759,
        'achievementsPublished' => 15,
        'pointsTotal' => 219,
        'guideUrl' => null,
        'id' => 14402,
        'title' => 'Dragster',
        'consoleId' => 25,
        'forumTopicId' => 9145,
        'flags' => 0,
        'imageIcon' => '/Images/072365.png',
        'imageTitle' => '/Images/026366.png',
        'imageInGame' => '/Images/026367.png',
        'imageBoxArt' => '/Images/066952.png',
        'publisher' => 'Activision',
        'developer' => 'David Crane',
        'genre' => 'Racing',
        'released' => '1980',
        'releasedAtGranularity' => 'day',
        'isFinal' => false,
        'richPresencePatch' => '2b92fa1bf9635c303b3b7f8feea3ed3c',
        'consoleName' => 'Atari 2600',
        'parentGameId' => null,
        'numDistinctPlayers' => 759,
        'numAchievements' => 15,
        'numDistinctPlayersCasual' => 759,
        'numDistinctPlayersHardcore' => 759,
    ];
}

it('given a game ID and a username, retrieves extended metadata about the game and that user\'s progress', function (): void {
    $response = RetroClient::getGameInfoAndUserProgress(
        username: 'xelnia',
        gameId: 14_402,
    );

    expect($response)
        ->toBeInstanceOf(GameInfoAndUserProgressData::class)
        ->and($response->transformed())
        ->toBe(expectedGameInfoAndUserProgress());
});

it('given a game ID and a username, retrieves extended metadata about the game and that user\'s progress in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGameInfoAndUserProgress(
        username: 'xelnia',
        gameId: 14_402,
    );

    expect($response)
        ->toBe(expectedGameInfoAndUserProgress());
});

it('given a game ID and a username, retrieves extended metadata about the game and that user\'s progress in array mode with RAW Properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getGameInfoAndUserProgress(
        username: 'xelnia',
        gameId: 14_402,
    );

    expect($response)
        ->toBe(fakeGameInfoAndUserProgress());
});
