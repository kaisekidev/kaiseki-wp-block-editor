<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

use function in_array;

final class DisableBlockEditorForPostTypes implements HookCallbackProviderInterface
{
    /** @var list<string> */
    private array $disabledPostTypes;

    /**
     * @param list<string> $disabledPostTypes
     */
    public function __construct(array $disabledPostTypes)
    {
        $this->disabledPostTypes = $disabledPostTypes;
    }

    public function registerCallbacks(): void
    {
        add_filter('use_block_editor_for_post_type', [$this, 'disableBlockEditorForPostType'], 10, 2);
    }

    public function disableBlockEditorForPostType(bool $useBlockEditor, string $postType): bool
    {
        return in_array($postType, $this->disabledPostTypes, true) ? false : $useBlockEditor;
    }
}
