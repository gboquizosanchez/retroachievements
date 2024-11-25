<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\Ticket\{
    AchievementTicketData,
    GameTicketData,
    MostTicketedData,
    RecentTicketData,
    Ticket,
    UserTicketData,
};
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Models\RetroAchievements::getTicketData */

it('given only a ticket ID, retrieves ticket data', function (): void {
    Http::fake([
        '*' => [
            'ID' => 10000,
            'AchievementID' => 3237,
            'AchievementTitle' => "Laura's Weapons",
            'AchievementDesc' => 'Obtained all available weapons as Laura',
            'AchievementType' => null,
            'Points' => 25,
            'BadgeName' => '61993',
            'AchievementAuthor' => 'PManningFan1618',
            'GameID' => 1474,
            'ConsoleName' => 'NES/Famicom',
            'GameTitle' => 'Friday the 13th',
            'GameIcon' => '/Images/062848.png',
            'ReportedAt' => '2017-10-16 06:10:52',
            'ReportType' => 1,
            'ReportState' => 2,
            'Hardcore' => null,
            'ReportNotes' => 'This lacks a ResetIf when the game is reset',
            'ReportedBy' => 'Thoreau',
            'ResolvedAt' => '2019-11-15 01:50:41',
            'ResolvedBy' => 'televandalist',
            'ReportStateDescription' => 'Resolved',
            'ReportTypeDescription' => 'Triggered at the wrong time',
            'URL' => 'https://retroachievements.org/ticket/10000',
        ],
    ]);

    $response = RetroClient::getTicketData(ticketId: 10_000);

    expect($response)
        ->toBeInstanceOf(Ticket::class)
        ->and($response->transformed())
        ->toBe([
            'id' => 10000,
            'achievementId' => 3237,
            'achievementTitle' => "Laura's Weapons",
            'achievementDesc' => 'Obtained all available weapons as Laura',
            'achievementType' => null,
            'points' => 25,
            'badgeName' => '61993',
            'achievementAuthor' => 'PManningFan1618',
            'gameId' => 1474,
            'consoleName' => 'NES/Famicom',
            'gameTitle' => 'Friday the 13th',
            'gameIcon' => '/Images/062848.png',
            'reportedAt' => '2017-10-16 06:10:52',
            'reportType' => 1,
            'reportState' => 2,
            'hardcore' => null,
            'reportNotes' => 'This lacks a ResetIf when the game is reset',
            'reportedBy' => 'Thoreau',
            'resolvedAt' => '2019-11-15 01:50:41',
            'resolvedBy' => 'televandalist',
            'reportStateDescription' => 'Resolved',
            'reportTypeDescription' => 'Triggered at the wrong time',
            'url' => 'https://retroachievements.org/ticket/10000',
        ]);
});

it('given no IDs, retrieves a list of recent tickets', function (): void {
    Http::fake(['*' => [
        'OpenTickets' => 1593,
        'URL' => 'https://retroachievements.org/tickets',
        'RecentTickets' => [
            [
                'ID' => 73841,
                'AchievementID' => 420221,
                'AchievementTitle' => 'Zandor Survivor',
                'AchievementDesc' => 'Clear the Zandor System without losing a life.',
                'AchievementType' => null,
                'Points' => 10,
                'BadgeName' => '490202',
                'AchievementAuthor' => 'Wulden',
                'GameID' => 1888,
                'ConsoleName' => 'NES/Famicom',
                'GameTitle' => 'Solar Jetman: Hunt for the Golden Warpship',
                'GameIcon' => '/Images/091926.png',
                'ReportedAt' => '2024-06-21 22:23:10',
                'ReportType' => 2,
                'ReportTypeDescription' => 'Did not trigger',
                'ReportNotes' => "
                    hello, i don't know if i did something wrong but the Achievements is still in the left corner, but when i escape from the 3rd planet, the achievements disappears and nothing unlock.\r\n
                    i make a savestate juste before the end of planet 3\r\n
                    https://mega.nz/file/E4gTkIhB#ojFtquVJkM6kR-XeZdI8cggOUmsI4bFpD_Uk11ZAdps\r\n
                    Thanks You ^^\n
                    RetroAchievements Hash: 45757bdf0d1a0e9de8f9590fb692da55\n
                    Emulator: RetroArch (mesen 0.9.9)\n
                    Emulator Version: 1.15.0",
                'ReportedBy' => 'Zouiguipopo',
                'ResolvedAt' => null,
                'ResolvedBy' => null,
                'ReportState' => 1,
                'ReportStateDescription' => 'Open',
                'Hardcore' => 1,
            ],
        ],
    ]]);

    $response = RetroClient::getTicketData();

    expect($response)
        ->toBeInstanceOf(RecentTicketData::class)
        ->and($response->transformed())
        ->toBe([
            'openTickets' => 1593,
            'url' => 'https://retroachievements.org/tickets',
            'recentTickets' => [
                [
                    'id' => 73841,
                    'achievementId' => 420221,
                    'achievementTitle' => 'Zandor Survivor',
                    'achievementDesc' => 'Clear the Zandor System without losing a life.',
                    'achievementType' => null,
                    'points' => 10,
                    'badgeName' => '490202',
                    'achievementAuthor' => 'Wulden',
                    'gameId' => 1888,
                    'consoleName' => 'NES/Famicom',
                    'gameTitle' => 'Solar Jetman: Hunt for the Golden Warpship',
                    'gameIcon' => '/Images/091926.png',
                    'reportedAt' => '2024-06-21 22:23:10',
                    'reportType' => 2,
                    'reportState' => 1,
                    'hardcore' => 1,
                    'reportNotes' => "
                    hello, i don't know if i did something wrong but the Achievements is still in the left corner, but when i escape from the 3rd planet, the achievements disappears and nothing unlock.\r\n
                    i make a savestate juste before the end of planet 3\r\n
                    https://mega.nz/file/E4gTkIhB#ojFtquVJkM6kR-XeZdI8cggOUmsI4bFpD_Uk11ZAdps\r\n
                    Thanks You ^^\n
                    RetroAchievements Hash: 45757bdf0d1a0e9de8f9590fb692da55\n
                    Emulator: RetroArch (mesen 0.9.9)\n
                    Emulator Version: 1.15.0",
                    'reportedBy' => 'Zouiguipopo',
                    'resolvedAt' => null,
                    'resolvedBy' => null,
                    'reportStateDescription' => 'Open',
                    'reportTypeDescription' => 'Did not trigger',
                ],
            ],
        ]);
});

it('can retrieve a list of the most ticketed games', function (): void {
    Http::fake(['*' => [
        'MostReportedGames' => [
            [
                'GameID' => 11334,
                'GameTitle' => 'Rayman 2: The Great Escape',
                'GameIcon' => '/Images/082262.png',
                'Console' => 'PlayStation',
                'OpenTickets' => 12,
            ],
            [
                'GameID' => 10248,
                'GameTitle' => 'Star Fox 64',
                'GameIcon' => '/Images/093951.png',
                'Console' => 'Nintendo 64',
                'OpenTickets' => 11,
            ],
        ],
        'URL' => 'https://retroachievements.org/tickets/most-reported-games',
    ]]);

    $response = RetroClient::getTicketData(isGettingMostTicketedGame: true);

    expect($response)
        ->toBeInstanceOf(MostTicketedData::class)
        ->and($response->transformed())
        ->toBe([
            'mostReportedGames' => [
                [
                    'gameId' => 11334,
                    'gameTitle' => 'Rayman 2: The Great Escape',
                    'gameIcon' => '/Images/082262.png',
                    'console' => 'PlayStation',
                    'openTickets' => 12,
                ],
                [
                    'gameId' => 10248,
                    'gameTitle' => 'Star Fox 64',
                    'gameIcon' => '/Images/093951.png',
                    'console' => 'Nintendo 64',
                    'openTickets' => 11,
                ],
            ],
            'url' => 'https://retroachievements.org/tickets/most-reported-games',
        ]);
});

it("can retrieve metadata about a user's tickets", function (): void {
    Http::fake([
        '*' => [
            'User' => 'Cheke',
            'Open' => 0,
            'Closed' => 2,
            'Resolved' => 1,
            'Total' => 3,
            'URL' => 'https://retroachievements.org/user/Cheke/tickets',
        ],
    ]);

    $response = RetroClient::getTicketData(username: 'Cheke');

    expect($response)
        ->toBeInstanceOf(UserTicketData::class)
        ->and($response->transformed())
        ->toBe([
            'user' => 'Cheke',
            'open' => 0,
            'closed' => 2,
            'resolved' => 1,
            'total' => 3,
            'url' => 'https://retroachievements.org/user/Cheke/tickets',
        ]);
});

it("can retrieve metadata about a game's tickets", function (): void {
    Http::fake([
        '*' => [
            'GameID' => 1474,
            'GameTitle' => 'Friday the 13th',
            'ConsoleName' => 'NES/Famicom',
            'OpenTickets' => 1,
            'URL' => 'https://retroachievements.org/game/1474/tickets',
        ],
    ]);

    $response = RetroClient::getTicketData(gameId: 1474);

    expect($response)
        ->toBeInstanceOf(GameTicketData::class)
        ->and($response->transformed())
        ->toBe([
            'gameId' => 1474,
            'gameTitle' => 'Friday the 13th',
            'consoleName' => 'NES/Famicom',
            'openTickets' => 1,
            'url' => 'https://retroachievements.org/game/1474/tickets',
        ]);
});

it("can retrieve metadata about an achievement's tickets", function (): void {
    Http::fake([
        '*' => [
            'AchievementID' => "3237",
            'AchievementTitle' => "Laura's Weapons",
            'achievementDescription' => 'Obtained all available weapons as Laura',
            'URL' => 'https://retroachievements.org/achievement/3237/tickets',
            'OpenTickets' => 0,
        ],
    ]);

    $response = RetroClient::getTicketData(achievementId: 3237);

    expect($response)
        ->toBeInstanceOf(AchievementTicketData::class)
        ->and($response->transformed())
        ->toBe([
            'achievementId' => 3237,
            'achievementTitle' => "Laura's Weapons",
            'achievementDescription' => 'Obtained all available weapons as Laura',
            'url' => 'https://retroachievements.org/achievement/3237/tickets',
            'openTickets' => 0,
        ]);
});
