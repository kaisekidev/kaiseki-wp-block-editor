<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

final class DequeueBlockAssets implements HookCallbackProviderInterface
{
    public function registerCallbacks(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'dequeueBlockLibraryStyles']);
    }

    public function dequeueBlockLibraryStyles(): void
    {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-block-style');
    }
}
