<?php

declare(strict_types=1);

namespace RetroAchievements;

use Illuminate\Support\ServiceProvider;
use RetroAchievements\Data\AuthData;
use RetroAchievements\Models\RetroAchievements;

final class RetroAchievementsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $configFile = 'retro-achievements.php';

            $this->publishes([
                __DIR__ . "/../config/{$configFile}" => config_path($configFile),
            ]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/retro-achievements.php',
            'retro-achievements',
        );

        $this->app->bind(
            'retro-achievements',
            static function () {
                /** @var array<string, string> $config */
                $config = config('retro-achievements.credentials');

                $authorization = new AuthData(
                    (string) $config['username'],
                    (string) $config['web_api_key'],
                );

                return new RetroAchievements($authorization);
            },
        );
    }
}
