<?php

declare(strict_types=1);

namespace RetroAchievements\Enums\Feed;

enum SetType: int
{
    case NewSet = 0;
    case Revision = 1;
}
