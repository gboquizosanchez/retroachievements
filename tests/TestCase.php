<?php

declare(strict_types=1);

namespace RetroAchievements\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use RetroAchievements\RetroAchievementsServiceProvider;
use Spatie\LaravelData\LaravelDataServiceProvider;

abstract class TestCase extends BaseTestCase
{
    /**
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string>
     */
    final public function getPackageProviders($app): array
    {
        return [
            RetroAchievementsServiceProvider::class,
            LaravelDataServiceProvider::class,
        ];
    }
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('retro-achievements.credentials', [
            'username' => 'myUsername',
            'web_api_key' => 'myWebApiKey',
        ]);
    }
}
