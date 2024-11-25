<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\User\UserAwardsData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasUser::getUserAwards */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeUserAwards(),
    ]);
});

function fakeUserAwards(): array
{
    return [
        'TotalAwardsCount' => 17,
        'HiddenAwardsCount' => 0,
        'MasteryAwardsCount' => 9,
        'CompletionAwardsCount' => 0,
        'BeatenHardcoreAwardsCount' => 8,
        'BeatenSoftcoreAwardsCount' => 0,
        'EventAwardsCount' => 0,
        'SiteAwardsCount' => 0,
        'VisibleUserAwards' => [
            [
                'AwardedAt' => '2022-08-04T23:21:25+00:00',
                'AwardType' => 'Game Beaten',
                'AwardData' => 6070,
                'AwardDataExtra' => 1,
                'DisplayOrder' => 0,
                'Title' => '~Homebrew~ 2048',
                'ConsoleID' => 7,
                'ConsoleName' => 'NES/Famicom',
                'Flags' => 0,
                'ImageIcon' => '/Images/066649.png',
            ],
        ],
    ];
}

function expectedUserAwards(): array
{
    return [
        'totalAwardsCount' => 17,
        'hiddenAwardsCount' => 0,
        'masteryAwardsCount' => 9,
        'completionAwardsCount' => 0,
        'beatenHardcoreAwardsCount' => 8,
        'beatenSoftcoreAwardsCount' => 0,
        'eventAwardsCount' => 0,
        'siteAwardsCount' => 0,
        'visibleUserAwards' => [
            [
                'awardedAt' => '2022-08-04T23:21:25+00:00',
                'awardType' => 'Game Beaten',
                'awardData' => 6070,
                'awardDataExtra' => 1,
                'displayOrder' => 0,
                'title' => '~Homebrew~ 2048',
                'consoleName' => 'NES/Famicom',
                'flags' => 0,
                'imageIcon' => '/Images/066649.png',
            ],
        ],
    ];
}

it('retrieves a list of a target user awards', function (): void {
    $response = RetroClient::getUserAwards(username: 'Cheke');

    expect($response)
        ->toBeInstanceOf(UserAwardsData::class)
        ->and($response->transformed())
        ->toBe(expectedUserAwards());
});

it('retrieves a list of a target user awards in array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserAwards(username: 'Cheke');

    expect($response)
        ->toBe(expectedUserAwards());
});

it('retrieves a list of a target user awards in array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getUserAwards(username: 'Cheke');

    expect($response)
        ->toBe(fakeUserAwards());
});
