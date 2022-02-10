<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

final class DisableEmbedVariations implements HookCallbackProviderInterface
{
    /** @var list<string> */
    private array $embedVariations;

    /**
     * @param list<string> $embedVariations
     */
    public function __construct(array $embedVariations)
    {
        $this->embedVariations = $embedVariations;
    }

    public function registerCallbacks(): void
    {
        add_action('enqueue_block_editor_assets', [$this, 'addInlineScript']);
    }

    public function addInlineScript(): void
    {
        $template = <<<'JS'
wp.domReady(() => {
    const allowedEmbedBlocks = %s;
    wp.blocks.getBlockVariations("core/embed").forEach(function (blockVariation) {
        if (-1 === allowedEmbedBlocks.indexOf(blockVariation.name)) {
          wp.blocks.unregisterBlockVariation("core/embed", blockVariation.name);
        }
    });
});
JS;
        $script = \Safe\sprintf($template, \Safe\json_encode($this->embedVariations));
        wp_add_inline_script('wp-block-directory', $script);
    }
}
