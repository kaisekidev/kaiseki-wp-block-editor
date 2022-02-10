<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Config\Config;
use Psr\Container\ContainerInterface;

final class DisableBlockEditorForPostTypesFactory
{
    public function __invoke(ContainerInterface $container): DisableBlockEditorForPostTypes
    {
        /** @var list<string> $postTypes */
        $postTypes = Config::get($container)->array('block_editor/disable_for_post_types');
        return new DisableBlockEditorForPostTypes($postTypes);
    }
}
