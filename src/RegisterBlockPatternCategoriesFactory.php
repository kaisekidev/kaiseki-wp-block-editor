<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Config\Config;
use Psr\Container\ContainerInterface;

final class RegisterBlockPatternCategoriesFactory
{
    public function __invoke(ContainerInterface $container): RegisterBlockPatternCategories
    {
        /** @var array<string, array{label: string}> $blockPatternPaths */
        $blockPatternPaths = Config::get($container)->array('block_editor/block_pattern_categories');
        return new RegisterBlockPatternCategories($blockPatternPaths);
    }
}
