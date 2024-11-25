<?php

declare(strict_types=1);

namespace RetroAchievements\Enums;

enum AwardKind: string
{
    case BeatenSoftcore = 'beaten-softcore';
    case BeatenHardcore = 'beaten-hardcore';
    case Completed = 'completed';
    case Mastered = 'mastered';
}
