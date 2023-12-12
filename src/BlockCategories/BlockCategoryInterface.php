<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\BlockCategories;

interface BlockCategoryInterface
{
    public function getSlug(): string;

    public function getTitle(): string;

    public function getIcon(): ?string;

    public function beforeSlug(): string;

    public function afterSlug(): string;
}
