<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

final class FilterEnterTitleHereFactory
{
    public function __invoke(ContainerInterface $container): EnterTitleHere
    {
        $config = Config::get($container);
        /** @var array<string, string> $titles */
        $titles = $config->get('block_editor/enter_title_here');
        return new EnterTitleHere($titles);
    }
}
