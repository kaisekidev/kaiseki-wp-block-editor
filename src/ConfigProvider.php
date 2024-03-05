<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\BlockEditor\BlockCategories\BlockCategoriesRegistry;
use Kaiseki\WordPress\BlockEditor\BlockCategories\BlockCategoriesRegistryFactory;
use Kaiseki\WordPress\BlockEditor\DisableBlockEditor\DisableBlockEditor;
use Kaiseki\WordPress\BlockEditor\DisableBlockEditor\DisableBlockEditorFactory;
use Kaiseki\WordPress\BlockEditor\EnterTitleHere\EnterTitleHereFilter;
use Kaiseki\WordPress\BlockEditor\EnterTitleHere\EnterTitleHereFilterFactory;

final class ConfigProvider
{
    /**
     * @return array<mixed>
     */
    public function __invoke(): array
    {
        return [
            'block_editor' => [
                'categories' => [
                    // BlockCategoryInterface::class
                ],
                'add_categories_at_top' => false,
                'disable_block_editor' => [
                    'post_types' => [],
                    'post_filter' => [],
                ],
                'enter_title_here' => [],
            ],
            'hook' => [
                'provider' => [],
            ],
            'dependencies' => [
                'aliases' => [],
                'factories' => [
                    BlockCategoriesRegistry::class => BlockCategoriesRegistryFactory::class,
                    DisableBlockEditor::class => DisableBlockEditorFactory::class,
                    EnterTitleHereFilter::class => EnterTitleHereFilterFactory::class,
                ],
            ],
        ];
    }
}
