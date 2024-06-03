<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\EmbedVariations;

use Kaiseki\WordPress\Hook\HookProviderInterface;

use function add_action;
use function json_encode;
use function wp_add_inline_script;

class DisableEmbedVariations implements HookProviderInterface
{
    /**
     * @param list<string> $variations
     */
    public function __construct(
        private readonly array $variations = [],
    ) {
    }

    public function addHooks(): void
    {
        if ($this->variations === []) {
            return;
        }
        add_action('enqueue_block_editor_assets', [$this, 'addInlineScript']);
    }

    public function addInlineScript(): void
    {
        $disallowedEmbedBlocks = json_encode($this->variations);
        $template = <<<JS
wp.domReady(function () {
    $disallowedEmbedBlocks.forEach(function (name) {
      wp.blocks.unregisterBlockVariation('core/embed', name);
    });
});
JS;
        wp_add_inline_script('wp-block-directory', $template);
    }
}
