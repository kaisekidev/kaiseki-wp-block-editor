<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\BlockEditor\BlockCategories\BlockCategoriesRegistry;

final class ConfigProvider
{
    /**
     * @return array<mixed>
     */
    public function __invoke(): array
    {
        return [
            'hook' => [
                'provider' => [],
            ],
            'dependencies' => [
                'aliases' => [],
                'factories' => [
                    BlockCategoriesRegistry::class => BlockCategories\BlockCategoriesRegistryFactory::class,
                    DisableBlockEditorForPostType::class => DisableBlockEditorForPostTypeFactory::class,
                    EnterTitleHere::class => FilterEnterTitleHereFactory::class,
                ],
            ],
        ];
    }
}
