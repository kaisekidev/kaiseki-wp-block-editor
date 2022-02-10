<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Config\Config;
use Psr\Container\ContainerInterface;

final class ConfigureAllowedBlockTypesFactory
{
    public function __invoke(ContainerInterface $container): ConfigureAllowedBlockTypes
    {
        /** @var list<array{post_types: list<string>, block_types: list<string>}> $allowed */
        $allowed = Config::get($container)->array('block_editor/allowed_block_types');
        return new ConfigureAllowedBlockTypes($allowed);
    }
}
