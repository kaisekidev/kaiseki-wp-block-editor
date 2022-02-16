<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;
use WP_Post;

use function in_array;

final class AddBlockCategories implements HookCallbackProviderInterface
{
    /** @var list<array{slug: string, title: string, icon: string|null}> */
    private array $categories;

    /**
     * @param list<array{slug: string, title: string, icon: string|null}> $categories
     */
    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }

    public function registerCallbacks(): void
    {
        add_filter('block_categories', [$this, 'addBlockCategories'], 10, 2);
    }

    /**
     * @param array<string, array{slug: string, title: string, icon: string|null}> $categories
     * @return array<mixed> $categories
     */
    public function addBlockCategories(array $categories, WP_Post $post): array
    {
        $categorySlugs = wp_list_pluck($categories, 'slug');
        foreach ($this->categories as $category) {
            if (in_array($category['slug'], $categorySlugs, true)) {
                continue;
            }
            $categories[] = $category;
        }
        return $categories;
    }
}
