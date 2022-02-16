<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Config\Config;
use Psr\Container\ContainerInterface;

final class AddBlockCategoriesFactory
{
    public function __invoke(ContainerInterface $container): AddBlockCategories
    {
        /** @var list<array{slug: string, title: string, icon: string|null}> $categories */
        $categories = Config::get($container)->array('block_editor/categories');
        return new AddBlockCategories($categories);
    }
}
