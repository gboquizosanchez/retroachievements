<?php

declare(strict_types=1);

namespace RetroAchievements;

use Spatie\LaravelData\Data as SpatieData;
use Spatie\LaravelData\Support\Transformation\TransformationContextFactory;

abstract class Data extends SpatieData
{
    /**
     * @phpstan-ignore-next-line
     */
    public function transformed(): array
    {
        $transformationContext = TransformationContextFactory::create()
            ->withoutPropertyNameMapping();

        return $this->transform($transformationContext);
    }
}
