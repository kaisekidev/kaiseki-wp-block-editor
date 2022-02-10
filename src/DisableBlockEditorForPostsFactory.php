<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Config\Config;
use Psr\Container\ContainerInterface;
use WP_Post;

final class DisableBlockEditorForPostsFactory
{
    public function __invoke(ContainerInterface $container): DisableBlockEditorForPosts
    {
        /** @var list<class-string> $classNames */
        $classNames = Config::get($container)->array('block_editor/disable_for_posts');
        /** @var list<callable(WP_Post): bool> $callables */
        $callables = Config::initClassMap($container, $classNames);
        return new DisableBlockEditorForPosts($callables);
    }
}
