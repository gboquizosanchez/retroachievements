<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Comment;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class CommentsData extends Data
{
    public int $count;

    public int $total;

    /**
     * @var array<int, \RetroAchievements\Data\Comment\Comments>
     */
    #[DataCollectionOf(Comments::class)]
    public array $results;
}
