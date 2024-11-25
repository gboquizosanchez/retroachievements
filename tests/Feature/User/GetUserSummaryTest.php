<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\UserSummaryData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getUserSummary */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeUserSummary(),
    ]);
});

function fakeUserSummary(): array
{
    return [
        'User' => 'Cheke',
        'MemberSince' => '2016-12-15 03:33:00',
        'LastActivity' => [
            'ID' => 0,
            'timestamp' => null,
            'lastupdate' => null,
            'activitytype' => null,
            'User' => 'Cheke',
            'data' => null,
            'data2' => null,
        ],
        'RichPresenceMsg' => 'Johto Gym Badges: 3/8 || Kanto Gym Badges: 0/8 || Pokemon Obtained: 132/206',
        'LastGameID' => 24140,
        'ContribCount' => 0,
        'ContribYield' => 0,
        'TotalPoints' => 6914,
        'TotalSoftcorePoints' => 0,
        'TotalTruePoints' => 31603,
        'Permissions' => 1,
        'Untracked' => 0,
        'ID' => 31359,
        'UserWallActive' => 1,
        'Motto' => 'Safer',
        'Rank' => 7246,
        'RecentlyPlayedCount' => 2,
        'RecentlyPlayed' => [
            [
                'GameID' => 24140,
                'ConsoleID' => 6,
                'ConsoleName' => 'Game Boy Color',
                'Title' => 'Pokemon Crystal Version [Subset - Professor Oak Challenge]',
                'ImageIcon' => '/Images/071892.png',
                'ImageTitle' => '/Images/072524.png',
                'ImageIngame' => '/Images/072525.png',
                'ImageBoxArt' => '/Images/078579.png',
                'LastPlayed' => '2024-06-25 10:01:05',
                'AchievementsTotal' => 224,
            ],
            [
                'GameID' => 25657,
                'ConsoleID' => 6,
                'ConsoleName' => 'Game Boy Color',
                'Title' => 'Pokemon Gold Version [Subset - Professor Oak Challenge]',
                'ImageIcon' => '/Images/083086.png',
                'ImageTitle' => '/Images/089977.png',
                'ImageIngame' => '/Images/089976.png',
                'ImageBoxArt' => '/Images/098765.png',
                'LastPlayed' => '2024-06-17 20:59:11',
                'AchievementsTotal' => 217,
            ],
        ],
        'Awarded' => [
            24140 => [
                'NumPossibleAchievements' => 224,
                'PossibleScore' => 505,
                'NumAchieved' => 135,
                'ScoreAchieved' => 233,
                'NumAchievedHardcore' => 135,
                'ScoreAchievedHardcore' => 233,
            ],
            25657 => [
                'NumPossibleAchievements' => 217,
                'PossibleScore' => 498,
                'NumAchieved' => 217,
                'ScoreAchieved' => 498,
                'NumAchievedHardcore' => 217,
                'ScoreAchievedHardcore' => 498,
            ],
        ],
        'RecentAchievements' => [
            24140 => [
                315287 => [
                    'ID' => 315287,
                    'GameID' => 24140,
                    'GameTitle' => 'Pokemon Crystal Version [Subset - Professor Oak Challenge]',
                    'Title' => 'Marill',
                    'Description' => 'Catch a Marill.',
                    'Points' => 1,
                    'Type' => null,
                    'BadgeName' => '349170',
                    'IsAwarded' => '1',
                    'DateAwarded' => '2024-06-24 19:42:17',
                    'HardcoreAchieved' => 1,
                ],
                315207 => [
                    'ID' => 315207,
                    'GameID' => 24140,
                    'GameTitle' => 'Pokemon Crystal Version [Subset - Professor Oak Challenge]',
                    'Title' => 'Weezing',
                    'Description' => 'Evolve Koffing or catch a Weezing.',
                    'Points' => 2,
                    'Type' => null,
                    'BadgeName' => '349066',
                    'IsAwarded' => '1',
                    'DateAwarded' => '2024-06-24 01:34:26',
                    'HardcoreAchieved' => 1,
                ],
            ],
        ],
        'LastGame' => [
            'ID' => 24140,
            'Title' => 'Pokemon Crystal Version [Subset - Professor Oak Challenge]',
            'ConsoleID' => 6,
            'ConsoleName' => 'Game Boy Color',
            'ForumTopicID' => 21400,
            'Flags' => 0,
            'ImageIcon' => '/Images/071892.png',
            'ImageTitle' => '/Images/072524.png',
            'ImageIngame' => '/Images/072525.png',
            'ImageBoxArt' => '/Images/078579.png',
            'Publisher' => 'Nintendo',
            'Developer' => 'Game Freak',
            'Genre' => 'Turn-based RPG',
            'Released' => 'December 14, 2000',
            'IsFinal' => 0,
        ],
        'UserPic' => '/UserPic/Cheke.png',
        'TotalRanked' => 63374,
        'Status' => 'Offline',
    ];
}

function expectedUserSummary(): array
{
    return [
        'user' => 'Cheke',
        'memberSince' => '2016-12-15 03:33:00',
        'lastActivity' => [
            'id' => 0,
            'timestamp' => null,
            'lastUpdate' => null,
            'activityType' => null,
            'user' => 'Cheke',
            'data' => null,
            'data2' => null,
        ],
        'richPresenceMsg' => 'Johto Gym Badges: 3/8 || Kanto Gym Badges: 0/8 || Pokemon Obtained: 132/206',
        'lastGameId' => 24140,
        'contribCount' => 0,
        'contribYield' => 0,
        'totalPoints' => 6914,
        'totalSoftcorePoints' => 0,
        'totalTruePoints' => 31603,
        'permissions' => 1,
        'untracked' => false,
        'id' => 31359,
        'userWallActive' => true,
        'motto' => 'Safer',
        'rank' => 7246,
        'recentlyPlayedCount' => 2,
        'recentlyPlayed' => [
            [
                'gameId' => 24140,
                'consoleId' => 6,
                'consoleName' => 'Game Boy Color',
                'title' => 'Pokemon Crystal Version [Subset - Professor Oak Challenge]',
                'imageIcon' => '/Images/071892.png',
                'imageTitle' => '/Images/072524.png',
                'imageInGame' => '/Images/072525.png',
                'imageBoxArt' => '/Images/078579.png',
                'lastPlayed' => '2024-06-25 10:01:05',
                'achievementsTotal' => 224,
            ],
            [
                'gameId' => 25657,
                'consoleId' => 6,
                'consoleName' => 'Game Boy Color',
                'title' => 'Pokemon Gold Version [Subset - Professor Oak Challenge]',
                'imageIcon' => '/Images/083086.png',
                'imageTitle' => '/Images/089977.png',
                'imageInGame' => '/Images/089976.png',
                'imageBoxArt' => '/Images/098765.png',
                'lastPlayed' => '2024-06-17 20:59:11',
                'achievementsTotal' => 217,
            ],
        ],
        'awarded' => [
            24140 => [
                'numPossibleAchievements' => 224,
                'possibleScore' => 505,
                'numAchieved' => 135,
                'scoreAchieved' => 233,
                'numAchievedHardcore' => 135,
                'scoreAchievedHardcore' => 233,
            ],
            25657 => [
                'numPossibleAchievements' => 217,
                'possibleScore' => 498,
                'numAchieved' => 217,
                'scoreAchieved' => 498,
                'numAchievedHardcore' => 217,
                'scoreAchievedHardcore' => 498,
            ],
        ],
        'recentAchievements' => [
            24140 => [
                315287 => [
                    'id' => 315287,
                    'gameId' => 24140,
                    'gameTitle' => 'Pokemon Crystal Version [Subset - Professor Oak Challenge]',
                    'title' => 'Marill',
                    'description' => 'Catch a Marill.',
                    'points' => 1,
                    'type' => null,
                    'badgeName' => '349170',
                    'isAwarded' => true,
                    'dateAwarded' => '2024-06-24 19:42:17',
                    'hardcoreAchieved' => true,
                ],
                315207 => [
                    'id' => 315207,
                    'gameId' => 24140,
                    'gameTitle' => 'Pokemon Crystal Version [Subset - Professor Oak Challenge]',
                    'title' => 'Weezing',
                    'description' => 'Evolve Koffing or catch a Weezing.',
                    'points' => 2,
                    'type' => null,
                    'badgeName' => '349066',
                    'isAwarded' => true,
                    'dateAwarded' => '2024-06-24 01:34:26',
                    'hardcoreAchieved' => true,
                ],
            ],
        ],
        'lastGame' => [
            'id' => 24140,
            'title' => 'Pokemon Crystal Version [Subset - Professor Oak Challenge]',
            'consoleId' => 6,
            'consoleName' => 'Game Boy Color',
            'forumTopicId' => 21400,
            'flags' => 0,
            'imageIcon' => '/Images/071892.png',
            'imageTitle' => '/Images/072524.png',
            'imageInGame' => '/Images/072525.png',
            'imageBoxArt' => '/Images/078579.png',
            'publisher' => 'Nintendo',
            'developer' => 'Game Freak',
            'genre' => 'Turn-based RPG',
            'released' => 'December 14, 2000',
            'isFinal' => false,
        ],
        'userPic' => '/UserPic/Cheke.png',
        'totalRanked' => 63374,
        'status' => 'Offline',
    ];
}

it('given a username, retrieves user summary information about the user', function (): void {
    $response = RetroClient::getUserSummary(
        username: 'Cheke',
        recentGamesCount: 2,
        recentAchievementsCount: 2,
    );

    expect($response)
        ->toBeInstanceOf(UserSummaryData::class)
        ->and($response->transformed())
        ->toBe(expectedUserSummary());
});

it('given a username, retrieves user summary information about the user in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserSummary(
        username: 'Cheke',
        recentGamesCount: 2,
        recentAchievementsCount: 2,
    );

    expect($response)
        ->toBe(expectedUserSummary());
});

it('given a username, retrieves user summary information about the user in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserSummary(
        username: 'Cheke',
        recentGamesCount: 2,
        recentAchievementsCount: 2,
    );

    expect($response)
        ->toBe(fakeUserSummary());
});
