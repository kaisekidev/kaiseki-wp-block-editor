<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\BlockCategories;

abstract class AbstractBlockCategory implements BlockCategoryInterface
{
    abstract public function getSlug(): string;

    abstract public function getTitle(): string;

    public function getIcon(): ?string
    {
        return null;
    }

    public function beforeSlug(): string
    {
        return '';
    }

    public function afterSlug(): string
    {
        return '';
    }
}
