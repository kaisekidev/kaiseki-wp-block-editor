<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Config\Config;
use Psr\Container\ContainerInterface;

final class RegisterBlockPatternFromPathFactory
{
    public function __invoke(ContainerInterface $container): RegisterBlockPatternFromPath
    {
        /** @var list<array{path: string, namespace: string}> $blockPatternPaths */
        $blockPatternPaths = Config::get($container)->array('block_editor/block_pattern_path');
        return new RegisterBlockPatternFromPath($blockPatternPaths);
    }
}
