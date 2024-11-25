<?php

declare(strict_types=1);

use RetroAchievements\Data\AuthData;

it('establish properly the object', function (): void {
    $authData = new AuthData(
        username: 'myUserName',
        webApiKey: 'myWebApiKey',
    );

    expect($authData->username)
        ->toBe('myUserName')
        ->and($authData->webApiKey)
        ->toBe('myWebApiKey');
});
