<?php

declare(strict_types=1);

namespace RetroAchievements\Data\Game;

use RetroAchievements\Data;
use Spatie\LaravelData\Attributes\{DataCollectionOf, MapName};
use Spatie\LaravelData\Mappers\StudlyCaseMapper;

#[MapName(StudlyCaseMapper::class)]
class GameExtendedData extends Data
{
    #[MapName('ID')]
    public int $id;

    public string $title;

    #[MapName('ConsoleID')]
    public int $consoleId;

    #[MapName('ForumTopicID')]
    public int $forumTopicId;

    public int | null $flags;

    public string $imageIcon;

    public string $imageTitle;

    #[MapName('ImageIngame')]
    public string $imageInGame;

    public string $imageBoxArt;

    public string $publisher;

    public string $developer;

    public string $genre;

    public string $released;

    public string | null $releasedAtGranularity;

    public bool $isFinal;

    public string $richPresencePatch;

    #[MapName('GuideURL')]
    public string | null $guideUrl;

    public string $updated;

    public string $consoleName;

    #[MapName('ParentGameID')]
    public int | null $parentGameId;

    public int $numDistinctPlayers;

    public int $numAchievements;

    /**
     * @var array<int, Achievement>
     */
    #[DataCollectionOf(Achievement::class)]
    public array $achievements;

    /**
     * @var array<int, Claim>
     */
    #[DataCollectionOf(Claim::class)]
    public array $claims;

    public int $numDistinctPlayersCasual;

    public int $numDistinctPlayersHardcore;
}
