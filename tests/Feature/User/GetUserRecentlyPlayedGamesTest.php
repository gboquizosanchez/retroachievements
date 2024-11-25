<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\UserRecentlyPlayedGamesData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getUserRecentlyPlayedGames */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeUserRecentlyPlayedGames(),
    ]);
});

function fakeUserRecentlyPlayedGames(): array
{
    return [
        [
            'GameID' => 3562,
            'ConsoleID' => 41,
            'ConsoleName' => 'PlayStation Portable',
            'Title' => 'The Legend of Heroes: A Tear of Vermillion',
            'ImageIcon' => '/Images/100541.png',
            'ImageTitle' => '/Images/052529.png',
            'ImageIngame' => '/Images/052530.png',
            'ImageBoxArt' => '/Images/046659.png',
            'LastPlayed' => '2024-11-24 05:22:22',
            'AchievementsTotal' => 76,
            'NumPossibleAchievements' => 76,
            'PossibleScore' => 436,
            'NumAchieved' => 62,
            'ScoreAchieved' => 313,
            'NumAchievedHardcore' => 62,
            'ScoreAchievedHardcore' => 313,
        ],
        [
            'GameID' => 858,
            'ConsoleID' => 3,
            'ConsoleName' => 'SNES/Super Famicom',
            'Title' => 'Claymates',
            'ImageIcon' => '/Images/103874.png',
            'ImageTitle' => '/Images/022839.png',
            'ImageIngame' => '/Images/022840.png',
            'ImageBoxArt' => '/Images/022841.png',
            'LastPlayed' => '2024-11-23 23:41:14',
            'AchievementsTotal' => 63,
            'NumPossibleAchievements' => 63,
            'PossibleScore' => 535,
            'NumAchieved' => 7,
            'ScoreAchieved' => 23,
            'NumAchievedHardcore' => 7,
            'ScoreAchievedHardcore' => 23,
        ],
    ];
}

function expectedUserRecentlyPlayedGames(): array
{
    return [
        [
            'gameId' => 3562,
            'consoleId' => 41,
            'consoleName' => 'PlayStation Portable',
            'title' => 'The Legend of Heroes: A Tear of Vermillion',
            'imageIcon' => '/Images/100541.png',
            'imageTitle' => '/Images/052529.png',
            'imageInGame' => '/Images/052530.png',
            'imageBoxArt' => '/Images/046659.png',
            'lastPlayed' => '2024-11-24 05:22:22',
            'achievementsTotal' => 76,
            'numPossibleAchievements' => 76,
            'possibleScore' => 436,
            'numAchieved' => 62,
            'scoreAchieved' => 313,
            'numAchievedHardcore' => 62,
            'scoreAchievedHardcore' => 313,
        ],
        [
            'gameId' => 858,
            'consoleId' => 3,
            'consoleName' => 'SNES/Super Famicom',
            'title' => 'Claymates',
            'imageIcon' => '/Images/103874.png',
            'imageTitle' => '/Images/022839.png',
            'imageInGame' => '/Images/022840.png',
            'imageBoxArt' => '/Images/022841.png',
            'lastPlayed' => '2024-11-23 23:41:14',
            'achievementsTotal' => 63,
            'numPossibleAchievements' => 63,
            'possibleScore' => 535,
            'numAchieved' => 7,
            'scoreAchieved' => 23,
            'numAchievedHardcore' => 7,
            'scoreAchievedHardcore' => 23,
        ],
    ];
}

it('retrieves a list of a given user\'s recently played games', function (): void {
    $response = RetroClient::getUserRecentlyPlayedGames(
        username: 'MaxMilyin',
    );

    expect($response)
        ->toBeInstanceOf(UserRecentlyPlayedGamesData::class)
        ->and($response->transformed())
        ->toBe(expectedUserRecentlyPlayedGames());
});

it('retrieves a list of a given user\'s recently played games in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserRecentlyPlayedGames(
        username: 'MaxMilyin',
    );

    expect($response)
        ->toBe(expectedUserRecentlyPlayedGames());
});

it('retrieves a list of a given user\'s recently played games in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserRecentlyPlayedGames(
        username: 'MaxMilyin',
    );

    expect($response)
        ->toBe(fakeUserRecentlyPlayedGames());
});
