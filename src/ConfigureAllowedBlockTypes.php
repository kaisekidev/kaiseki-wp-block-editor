<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;
use WP_Post;

use function array_merge;
use function count;
use function in_array;

final class ConfigureAllowedBlockTypes implements HookCallbackProviderInterface
{
    /** @var list<array{post_types: list<string>, block_types: list<string>}> */
    private array $blockTypeConfigs;

    /**
     * @param list<array{post_types: list<string>, block_types: list<string>}> $blockTypeConfigs
     */
    public function __construct(array $blockTypeConfigs)
    {
        $this->blockTypeConfigs = $blockTypeConfigs;
    }

    public function registerCallbacks(): void
    {
        add_filter('allowed_block_types', [$this, 'updateAllowedBlockTypes'], 10, 2);
    }

    /**
     * @param array<mixed>|bool $allowedBlockTypes
     * @return array<mixed>|bool
     */
    public function updateAllowedBlockTypes($allowedBlockTypes, WP_Post $post)
    {
        $blockTypes = [];
        foreach ($this->blockTypeConfigs as $config) {
            //phpcs:disable Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps -- Not our code
            if (!in_array($post->post_type, $config['post_types'], true)) {
                continue;
            }
            // phpcs:enable

            $blockTypes[] = $config['post_types'];
        }
        return count($blockTypes) < 1 ? $allowedBlockTypes : array_merge(...$blockTypes);
    }
}
