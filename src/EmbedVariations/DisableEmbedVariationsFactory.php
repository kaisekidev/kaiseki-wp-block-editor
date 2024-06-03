<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\EmbedVariations;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

final class DisableEmbedVariationsFactory
{
    public function __invoke(ContainerInterface $container): DisableEmbedVariations
    {
        $config = Config::fromContainer($container);
        /** @var list<string> $variations */
        $variations = $config->array('block_editor.embed_variations.disable');

        return new DisableEmbedVariations($variations);
    }
}
