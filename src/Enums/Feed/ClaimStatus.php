<?php

declare(strict_types=1);

namespace RetroAchievements\Enums\Feed;

enum ClaimStatus: int
{
    case Active = 0;
    case Complete = 1;
    case Dropped = 2;
    case Expired = 3;
}
