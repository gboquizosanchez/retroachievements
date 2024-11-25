<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Comment;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
final class Comments extends Data
{
    public string $user;

    public string $submitted;

    #[MapName('CommentText')]
    public string $commentText;
}
