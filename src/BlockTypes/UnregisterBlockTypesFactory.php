<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\BlockTypes;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

final class UnregisterBlockTypesFactory
{
    public function __invoke(ContainerInterface $container): UnregisterBlockTypes
    {
        $config = Config::fromContainer($container);
        /** @var list<string> $blockTypes */
        $blockTypes = $config->array('block_editor.block_types.unregister');

        return new UnregisterBlockTypes($blockTypes);
    }
}
