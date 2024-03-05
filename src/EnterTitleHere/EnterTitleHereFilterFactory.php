<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\EnterTitleHere;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

final class EnterTitleHereFilterFactory
{
    public function __invoke(ContainerInterface $container): EnterTitleHereFilter
    {
        $config = Config::fromContainer($container);
        /** @var array<string, string> $titles */
        $titles = $config->array('block_editor.enter_title_here');

        return new EnterTitleHereFilter($titles);
    }
}
