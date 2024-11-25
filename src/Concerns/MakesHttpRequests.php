<?php

declare(strict_types=1);

namespace RetroAchievements\Concerns;

use Illuminate\Http\Client\{
    PendingRequest,
    Response,
};
use RetroAchievements\Exceptions\{
    GenericException,
    NotFoundException,
    UnauthorizedException,
};

trait MakesHttpRequests
{
    protected PendingRequest $client;

    /**
     * @param  array<string, mixed>  $payload
     */
    final public function request(string $uri, array $payload = []): mixed
    {
        $options = $payload === [] ? $payload : ['form_params' => $payload];

        $response = $this->client->send('GET', $uri, $options);

        if (! $this->isSuccessful($response)) {
            $this->handleRequestError($response);
        }
        return json_decode($response->body(), true);
    }

    private function isSuccessful(Response $response): bool
    {
        return (int) mb_substr((string) $response->status(), 0, 1) === 2;
    }

    /**
     * @throws GenericException
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    private function handleRequestError(Response $response): void
    {
        $body = $response->body();
        $status = $response->status();

        if ($status === 404) {
            throw new NotFoundException($body);
        }

        if ($status === 401) {
            throw new UnauthorizedException($body);
        }

        if (! json_validate($body)) {
            throw new GenericException('Invalid JSON response');
        }

        throw new GenericException($body);
    }
}
