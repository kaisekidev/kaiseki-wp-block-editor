<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\EnterTitleHere;

use Kaiseki\WordPress\Hook\HookProviderInterface;
use WP_Post;

use function add_filter;

final class EnterTitleHereFilter implements HookProviderInterface
{
    /**
     * @param array<string, string> $titles
     */
    public function __construct(private readonly array $titles)
    {
    }

    public function addHooks(): void
    {
        add_filter('enter_title_here', [$this, 'filterTitle'], 10, 2);
    }

    /**
     * @param string  $title
     * @param WP_Post $post
     *
     * @return string
     */
    public function filterTitle(string $title, WP_Post $post): string
    {
        if (isset($this->titles[$post->post_type])) {
            return $this->titles[$post->post_type];
        }

        return $title;
    }
}
