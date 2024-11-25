<?php

declare(strict_types=1);

namespace RetroAchievements\Data;

use SensitiveParameter;

final readonly class AuthData
{
    public function __construct(
        public string $username,
        #[SensitiveParameter]
        public string $webApiKey,
    ) {}

    /**
     * @return array<string, string>
     */
    public function credentials(): array
    {
        return [
            'z' => $this->username,
            'y' => $this->webApiKey,
        ];
    }
}
