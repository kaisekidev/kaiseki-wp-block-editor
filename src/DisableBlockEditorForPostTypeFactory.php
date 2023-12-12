<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

final class DisableBlockEditorForPostTypeFactory
{
    public function __invoke(ContainerInterface $container): DisableBlockEditorForPostType
    {
        $config = Config::get($container);
        /** @var list<string> $postTypes */
        $postTypes = $config->array('block_editor/disable_block_editor_for_post_type');
        return new DisableBlockEditorForPostType($postTypes);
    }
}
