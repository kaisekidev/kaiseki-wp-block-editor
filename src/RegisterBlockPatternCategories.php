<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;
use WP_Block_Pattern_Categories_Registry;

final class RegisterBlockPatternCategories implements HookCallbackProviderInterface
{
    /** @var array<string, array{label: string}> */
    private array $categories;

    /**
     * @param array<string, array{label: string}> $categories Indexed by category name, value is array with properties
     */
    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }

    public function registerCallbacks(): void
    {
        add_filter('init', [$this, '__invoke']);
    }

    public function __invoke(): void
    {
        foreach ($this->categories as $name => $properties) {
            if (WP_Block_Pattern_Categories_Registry::get_instance()->is_registered($name)) {
                return;
            }
            register_block_pattern_category($name, $properties);
        }
    }
}
