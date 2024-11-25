<?php

declare(strict_types=1);

namespace RetroAchievements\Exceptions;

use Exception;

final class NotFoundException extends Exception implements RetroAchievementsException {}
