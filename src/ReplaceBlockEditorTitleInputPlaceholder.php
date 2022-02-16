<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;
use WP_Post;

final class ReplaceBlockEditorTitleInputPlaceholder implements HookCallbackProviderInterface
{
    /** @var array<string, string> */
    private array $postTypePlaceholder;

    /**
     * @param array<string, string> $postTypePlaceholder
     */
    public function __construct(array $postTypePlaceholder)
    {
        $this->postTypePlaceholder = $postTypePlaceholder;
    }

    public function registerCallbacks(): void
    {
        add_filter('enter_title_here', [$this, 'updateEditorTitlePlaceholder'], 10, 2);
    }

    public function updateEditorTitlePlaceholder(string $text, WP_Post $post): string
    {
        //phpcs:disable Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps -- Not our code
        $placeholder = $this->postTypePlaceholder[$post->post_type] ?? null;
        // phpcs:enable
        return $placeholder ?? $text;
    }
}
