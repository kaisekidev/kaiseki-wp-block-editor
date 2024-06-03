<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\EmbedVariations;

use Kaiseki\WordPress\Hook\HookProviderInterface;

use function add_action;
use function json_encode;
use function wp_add_inline_script;

class EnableEmbedVariations implements HookProviderInterface
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
        add_action('enqueue_block_editor_assets', [$this, 'addInlineScript']);
    }

    public function addInlineScript(): void
    {
        $allowedEmbedBlocks = json_encode($this->variations);
        $template = <<<JS
wp.domReady(function () {
    wp.blocks.getBlockVariations("core/embed").forEach(function (blockVariation) {
        if (-1 === $allowedEmbedBlocks.indexOf(blockVariation.name)) {
          wp.blocks.unregisterBlockVariation("core/embed", blockVariation.name);
        }
    });
});
JS;
        wp_add_inline_script('wp-block-directory', $template);
    }
}
