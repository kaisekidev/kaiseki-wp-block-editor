<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\BlockTypes;

use Kaiseki\WordPress\Hook\HookProviderInterface;

use function add_action;
use function json_encode;
use function wp_add_inline_script;

class UnregisterBlockTypes implements HookProviderInterface
{
    /**
     * @param list<string> $blockTypes
     */
    public function __construct(
        private readonly array $blockTypes = [],
    ) {
    }

    public function addHooks(): void
    {
        if ($this->blockTypes === []) {
            return;
        }
        add_action('enqueue_block_editor_assets', [$this, 'addInlineScript']);
    }

    public function addInlineScript(): void
    {
        $blockTypes = json_encode($this->blockTypes);
        $template = <<<JS
wp.domReady(function () {
    $blockTypes.forEach(function (name) {
      wp.blocks.unregisterBlockType(name);
    });
});
JS;
        wp_add_inline_script('wp-block-directory', $template);
    }
}
