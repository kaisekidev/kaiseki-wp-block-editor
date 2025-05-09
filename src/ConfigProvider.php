<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\BlockEditor\BlockCategories\BlockCategoriesRegistry;
use Kaiseki\WordPress\BlockEditor\BlockCategories\BlockCategoriesRegistryFactory;
use Kaiseki\WordPress\BlockEditor\BlockTypes\UnregisterBlockTypes;
use Kaiseki\WordPress\BlockEditor\BlockTypes\UnregisterBlockTypesFactory;
use Kaiseki\WordPress\BlockEditor\DisableBlockEditor\DisableBlockEditor;
use Kaiseki\WordPress\BlockEditor\DisableBlockEditor\DisableBlockEditorFactory;
use Kaiseki\WordPress\BlockEditor\EmbedVariations\DisableEmbedVariations;
use Kaiseki\WordPress\BlockEditor\EmbedVariations\DisableEmbedVariationsFactory;
use Kaiseki\WordPress\BlockEditor\EmbedVariations\EnableEmbedVariations;
use Kaiseki\WordPress\BlockEditor\EmbedVariations\EnableEmbedVariationsFactory;
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
                'add_categories_at_top' => false,
                'categories' => [
                    // BlockCategoryInterface::class
                ],
                'disable_block_editor' => [
                    'post_types' => [],
                    'post_filter' => [],
                ],
                'embed_variations' => [
                    'disable' => [],
                    'enable' => [],
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
                    DisableEmbedVariations::class => DisableEmbedVariationsFactory::class,
                    EnableEmbedVariations::class => EnableEmbedVariationsFactory::class,
                    EnterTitleHereFilter::class => EnterTitleHereFilterFactory::class,
                    UnregisterBlockTypes::class => UnregisterBlockTypesFactory::class,
                ],
            ],
        ];
    }
}
