<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\BlockCategories;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

final class BlockCategoriesRegistryFactory
{
    public function __invoke(ContainerInterface $container): BlockCategoriesRegistry
    {
        $config = Config::get($container);
        /** @var list<class-string<BlockCategoryInterface>> $categories */
        $categories = $config->array('block_editor/categories');
        return new BlockCategoriesRegistry($categories, $config->bool('block_editor/add_at_top', false));
    }
}
