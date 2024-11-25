<?php

declare(strict_types=1);

namespace RetroAchievements\Concerns;

use InvalidArgumentException;
use RetroAchievements\Data\Comment\CommentsData;

trait HasComment
{
    /**
     * @link https://api-docs.retroachievements.org/v1/get-comments.html
     *
     * @return \RetroAchievements\Data\Comment\CommentsData|array<string, mixed>
     */
    final public function getComments(
        string $type,
        int $id,
        int | null $count = null,
        int | null $offset = null,
    ): CommentsData | array {
        $validTypes = [
            'game',
            'achievement',
            'user',
        ];

        if (! in_array($type, $validTypes)) {
            throw new InvalidArgumentException(
                "Invalid type: {$type}. Valid values are: game, achievement or user.",
            );
        }

        $mapValues = [
            'game' => '1',
            'achievement' => '2',
            'user' => '3',
        ];

        $data = $this->call('API_GetComments.php', [
            't' => $mapValues[$type],
            'i' => $id,
            'c' => $count,
            'o' => $offset,
        ]);

        return $this->response($data, CommentsData::class);
    }
}
