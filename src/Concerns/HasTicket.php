<?php

declare(strict_types=1);

namespace RetroAchievements\Concerns;

use RetroAchievements\Data;
use RetroAchievements\Data\Ticket\{
    AchievementTicketData,
    GameTicketData,
    MostTicketedData,
    RecentTicketData,
    Ticket,
    UserTicketData,
};
use RetroAchievements\Enums\AchievementDistributionFlags;

trait HasTicket
{
    /**
     * @link https://api-docs.retroachievements.org/v1/get-ticket-data/get-ticket-by-id.html
     * @link https://api-docs.retroachievements.org/v1/get-ticket-data/get-most-ticketed-games.html
     * @link https://api-docs.retroachievements.org/v1/get-ticket-data/get-most-recent-tickets.html
     * @link https://api-docs.retroachievements.org/v1/get-ticket-data/get-game-ticket-stats.html
     * @link https://api-docs.retroachievements.org/v1/get-ticket-data/get-developer-ticket-stats.html
     * @link https://api-docs.retroachievements.org/v1/get-ticket-data/get-achievement-ticket-stats.html
     *
     * @return \RetroAchievements\Data|array<string, mixed>
     */
    final public function getTicketData(
        int | string | null $ticketId = null,
        int | null $offset = null,
        int | null $count = null,
        true | null $isGettingMostTicketedGame = null,
        string | null $username = null,
        int | string | null $gameId = null,
        true | null $isGettingTicketsForUnofficialAchievements = null,
        true | null $shouldReturnTicketsList = null,
        int | string | null $achievementId = null,
    ): Data | array {
        $parameters = [];

        if ($ticketId !== null) {
            $parameters['i'] = $ticketId;
        } elseif ($isGettingMostTicketedGame) {
            $parameters['f'] = (int) $isGettingMostTicketedGame;

            $parameters = $this->applyPagination($parameters, $offset, $count);
        } elseif ($username !== null) {
            $parameters['u'] = $username;
        } elseif ($gameId !== null) {
            $parameters['g'] = $gameId;

            if ($isGettingTicketsForUnofficialAchievements) {
                $parameters['f'] = AchievementDistributionFlags::UnofficialAchievements->value;
            }

            if ($shouldReturnTicketsList) {
                $parameters['d'] = (int) $shouldReturnTicketsList;
            }
        } elseif ($achievementId !== null) {
            $parameters['a'] = $achievementId;
        } else {
            $parameters = $this->applyPagination($parameters, $offset, $count);
        }

        $data = $this->call('API_GetTicketData.php', $parameters);

        return $this->resolve($data, $parameters);
    }

    /**
     * @param array<int, int|string|true|null> $data
     * @param array<'a'|'c'|'d'|'f'|'g'|'i'|'o'|'u'|int, int|string|true|null> $parameters
     *
     * @return array<string, mixed>|Data
     */
    private function resolve(array $data, array $parameters = []): Data | array
    {
        if (isset($parameters['i'])) {
            return $this->response($data, Ticket::class);
        }

        if (isset($parameters['f'])) {
            return $this->response($data, MostTicketedData::class);
        }

        if (isset($parameters['o']) || isset($parameters['c'])) {
            return $this->response($data, RecentTicketData::class);
        }

        if (isset($parameters['u'])) {
            return $this->response($data, UserTicketData::class);
        }

        if (isset($parameters['g'])) {
            return $this->response($data, GameTicketData::class);
        }

        if (isset($parameters['a'])) {
            return $this->response($data, AchievementTicketData::class);
        }

        return $this->response($data, RecentTicketData::class);
    }

    /**
     * @param array{}|array{f: 1} $parameters
     *
     * @return array{}|array{f?: 1, o?: int, c?: int}
     */
    private function applyPagination(
        array $parameters,
        int | null $offset,
        int | null $count,
    ): array {
        if ($offset !== null) {
            $parameters['o'] = $offset;
        }

        if ($count !== null) {
            $parameters['c'] = $count;
        }

        return $parameters;
    }
}
