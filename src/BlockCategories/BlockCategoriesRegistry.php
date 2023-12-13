<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\BlockCategories;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

use function array_search;
use function array_splice;
use function array_unshift;
use function in_array;
use function is_int;

/**
 * @phpstan-type Category array{slug: string, title: string, icon: string|null}
 */
final class BlockCategoriesRegistry implements HookCallbackProviderInterface
{
    /**
     * @param list<BlockCategoryInterface> $categories
     */
    public function __construct(
        private readonly array $categories,
        private readonly bool $addAtTop = false
    ) {
    }

    public function registerHookCallbacks(): void
    {
        add_filter('block_categories_all', [$this, 'addBlockCategories']);
    }

    /**
     * @param list<Category> $categories
     *
     * @return list<Category>
     */
    public function addBlockCategories(array $categories): array
    {
        $categorySlugs = wp_list_pluck($categories, 'slug');

        foreach ($this->categories as $category) {
            if (in_array($category->getSlug(), $categorySlugs, true)) {
                continue;
            }

            $categoryArray = $this->createCategory($category);

            if ($category->beforeSlug() !== '' || $category->afterSlug() !== '') {
                $needle = $category->beforeSlug() !== '' ? $category->beforeSlug() : $category->afterSlug();
                $index = array_search($needle, $categorySlugs, true);
                if (is_int($index)) {
                    $offset = $index + ($category->beforeSlug() !== '' ? 0 : 1);
                    array_splice($categories, $offset, 0, [$categoryArray]);
                    continue;
                }
            }

            if ($this->addAtTop) {
                array_unshift($categories, $categoryArray);
                continue;
            }

            $categories[] = $categoryArray;
        }

        return $categories;
    }

    /**
     * @param BlockCategoryInterface $category
     *
     * @return Category
     */
    private function createCategory(BlockCategoryInterface $category): array
    {
        return [
            'slug' => $category->getSlug(),
            'title' => $category->getTitle(),
            'icon' => $category->getIcon(),
        ];
    }
}
