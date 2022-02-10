<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Config\Config;
use Psr\Container\ContainerInterface;

final class ReplaceBlockEditorTitleInputPlaceholderFactory
{
    public function __invoke(ContainerInterface $container): ReplaceBlockEditorTitleInputPlaceholder
    {
        /** @var array<string, string> $titlePlaceholders */
        $titlePlaceholders = Config::get($container)->array('block_editor/title_input_placeholder');
        return new ReplaceBlockEditorTitleInputPlaceholder($titlePlaceholders);
    }
}
