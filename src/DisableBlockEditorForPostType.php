<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

use function in_array;

final class DisableBlockEditorForPostType implements HookCallbackProviderInterface
{
    /**
     * @param list<string> $postTypes
     */
    public function __construct(private readonly array $postTypes)
    {
    }

    public function registerHookCallbacks(): void
    {
        add_filter('use_block_editor_for_post_type', [$this, 'disableBlockEditorForPostType'], 10, 2);
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
}
