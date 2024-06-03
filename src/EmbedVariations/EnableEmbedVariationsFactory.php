<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\EmbedVariations;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

final class EnableEmbedVariationsFactory
{
    public function __invoke(ContainerInterface $container): EnableEmbedVariations
    {
        $config = Config::fromContainer($container);
        /** @var list<string> $variations */
        $variations = $config->array('block_editor.embed_variations.enable');

        return new EnableEmbedVariations($variations);
    }
}
