<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\DisableBlockEditor;

use Kaiseki\WordPress\Hook\HookProviderInterface;
use WP_Post;

use function add_filter;
use function in_array;

final class DisableBlockEditor implements HookProviderInterface
{
    /**
     * @param list<string>                  $postTypes
     * @param list<callable(WP_Post): bool> $postFilter
     */
    public function __construct(
        private readonly array $postTypes = [],
        private readonly array $postFilter = []
    ) {
    }

    public function addHooks(): void
    {
        add_filter('use_block_editor_for_post_type', [$this, 'disableBlockEditorForPostType'], 10, 2);
        add_filter('use_block_editor_for_post', [$this, 'disableBlockEditorForPost'], 10, 2);
    }

    /**
     * @param bool   $useBlockEditor
     * @param string $postType
     *
     * @return bool
     */
    public function disableBlockEditorForPostType(bool $useBlockEditor, string $postType): bool
    {
        if (in_array($postType, $this->postTypes, true)) {
            return false;
        }

        return $useBlockEditor;
    }

    public function disableBlockEditorForPost(bool $useBlockEditor, WP_Post $post): bool
    {
        foreach ($this->postFilter as $filter) {
            if (($filter)($post)) {
                return false;
            }
        }

        return $useBlockEditor;
    }
}
