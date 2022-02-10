<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

final class DisableFullscreenMode implements HookCallbackProviderInterface
{
    public function registerCallbacks(): void
    {
        add_filter('enqueue_block_editor_assets', [$this, 'disableFullScreenEditor']);
    }

    public function disableFullScreenEditor(): void
    {
        $script = <<<JS
wp.domReady(() => {
    const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' );
    if ( !isFullscreenMode ) {
        return;
    }
    wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' );
});
JS;
        wp_add_inline_script('wp-blocks', $script);
    }
}
