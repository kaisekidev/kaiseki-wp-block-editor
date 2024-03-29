<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\BlockCategories;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

final class BlockCategoriesRegistryFactory
{
    public function __invoke(ContainerInterface $container): BlockCategoriesRegistry
    {
        $config = Config::fromContainer($container);
        /** @var list<class-string<BlockCategoryInterface>> $categoryClassStrings */
        $categoryClassStrings = $config->array('block_editor.categories');
        /** @var list<BlockCategoryInterface> $categories */
        $categories = Config::initClassMap($container, $categoryClassStrings);

        return new BlockCategoriesRegistry(
            $categories,
            $config->bool('block_editor.add_categories_at_top')
        );
    }
}
