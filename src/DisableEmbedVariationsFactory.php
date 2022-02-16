<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Config\Config;
use Psr\Container\ContainerInterface;

final class DisableEmbedVariationsFactory
{
    public function __invoke(ContainerInterface $container): DisableEmbedVariations
    {
        /** @var list<string> $disabledEmbeds */
        $disabledEmbeds = Config::get($container)->array('block_editor/allowed_embed_variations');
        return new DisableEmbedVariations($disabledEmbeds);
    }
}
