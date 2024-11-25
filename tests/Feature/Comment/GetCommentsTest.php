<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use RetroAchievements\Data\Comment\CommentsData;
use RetroAchievements\RetroClient;

/** @see \RetroAchievements\Concerns\HasComment::getComments */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeComments(),
    ]);
});

function fakeComments(): array
{
    return [
        'Count' => 1,
        'Total' => 1,
        'Results' => [
            [
                'User' => "Server",
                'Submitted' => "2019-08-03T02:26:00",
                'CommentText' => 'MrOwnership edited this achievement.',
            ],
        ],
    ];
}

function expectedComments(): array
{
    return [
        'count' => 1,
        'total' => 1,
        'results' => [
            [
                'user' => "Server",
                'submitted' => "2019-08-03T02:26:00",
                'commentText' => 'MrOwnership edited this achievement.',
            ],
        ],
    ];
}

it('retrieves metadata about comments', function (): void {
    $response = RetroClient::getComments('achievement', 1);

    expect($response)
        ->toBeInstanceOf(CommentsData::class)
        ->and($response->transformed())
        ->toBe(expectedComments());
});

it('retrieves metadata about comments array mode', function (): void {
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response = RetroClient::getComments('achievement', 1);

    expect($response)
        ->toBe(expectedComments());
});

it('retrieves metadata about comments array mode with RAW properties', function (): void {
    $this->app['config']->set('retro-achievements.mapping.raw_properties', true);
    $this->app['config']->set('retro-achievements.mapping.dto', false);

    $response =  RetroClient::getComments('achievement', 1);

    expect($response)
        ->toBe(fakeComments());
});
