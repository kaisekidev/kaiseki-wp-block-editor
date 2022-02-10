<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;
use WP_Post;

final class DisableBlockEditorForPosts implements HookCallbackProviderInterface
{
    /** @var list<callable(WP_Post): bool> */
    private array $postCheckers;

    /**
     * @param list<callable(WP_Post): bool> $postCheckers
     */
    public function __construct(array $postCheckers)
    {
        $this->postCheckers = $postCheckers;
    }

    public function registerCallbacks(): void
    {
        add_filter('use_block_editor_for_post', [$this, 'disableBlockEditorForPost'], 10, 2);
    }

    public function disableBlockEditorForPost(bool $useBlockEditor, WP_Post $post): bool
    {
        foreach ($this->postCheckers as $checker) {
            if (($checker)($post)) {
                return false;
            }
        }
        return $useBlockEditor;
    }
}
