<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

final class EnterTitleHere implements HookCallbackProviderInterface
{
    /**
     * @param array<string, string> $titles
     */
    public function __construct(private readonly array $titles)
    {
    }

    public function registerHookCallbacks(): void
    {
        add_filter('enter_title_here', [$this, 'filterTitle'], 10, 2);
    }

    /**
     * @param string   $title
     * @param \WP_Post $post
     *
     * @return string
     */
    public function filterTitle(string $title, \WP_Post $post): string
    {
        if (isset($this->titles[$post->post_type])) {
            return $this->titles[$post->post_type];
        }
        return $title;
    }
}
