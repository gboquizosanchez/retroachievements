<?php

declare(strict_types=1);

namespace RetroAchievements\Models;

use Illuminate\Support\Facades\{
    Config,
    Http,
};
use RetroAchievements\Concerns\{
    HasAchievement,
    HasComment,
    HasEvent,
    HasFeed,
    HasGame,
    HasLeaderboard,
    HasSystem,
    HasTicket,
    HasUser,
    MakesHttpRequests,
};
use RetroAchievements\Data\AuthData;
use RetroAchievements\Data;

final class RetroAchievements
{
    use HasAchievement;
    use HasComment;
    use HasEvent;
    use HasFeed;
    use HasGame;
    use HasLeaderboard;
    use HasSystem;
    use HasTicket;
    use HasUser;
    use MakesHttpRequests;

    public function __construct(
        private readonly AuthData $authorization,
    ) {
        $url = Config::get('retro-achievements.base_url');

        assert(is_string($url));

        $this->client = Http::baseUrl($url)
            ->withHeader(
                'User-Agent',
                'RetroAchievements API Client',
            )
            ->acceptJson()
            ->contentType('application/json');
    }

    /**
     * @phpstan-ignore-next-line
     */
    public function call(
        string $endpoint,
        array $parameters = [],
        bool $filtered = true,
    ): array {
        if ($filtered) {
            $parameters = array_filter($parameters);
        }

        $request = $this->request(
            $this->url($endpoint, $parameters),
        );

        assert(is_array($request));

        return $request;
    }

    /**
     * @param array<string, mixed> $parameters
     */
    public function url(string $endpoint, array $parameters): string
    {
        return sprintf('%s?%s', $endpoint, $this->buildQuery($parameters));
    }

    /**
     * @param array<string, mixed> $parameters
     */
    private function buildQuery(array $parameters = []): string
    {
        return http_build_query(
            $this->authorization->credentials() + $parameters,
        );
    }

    /**
     * @param array<string, mixed>|array<int, int|string|true|null> $data
     * @param class-string<Data> $dto
     *
     * @template Data of \RetroAchievements\Data
     * @return array<mixed>|Data
     */
    public function response(
        array $data,
        string $dto,
        ?string $mapKey = null,
    ): array | Data {
        if (config('retro-achievements.mapping.raw_properties')) {
            return $data;
        }

        $dtoInstance = $mapKey === null ? $dto::from($data) : $dto::from([
            $mapKey => $data,
        ]);

        if (config('retro-achievements.mapping.dto')) {
            return $dtoInstance;
        }

        return $dtoInstance->transformed();
    }
}
