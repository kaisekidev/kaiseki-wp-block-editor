<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

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
                    DisableBlockEditorForPostType::class => DisableBlockEditorForPostTypeFactory::class,
                    EnterTitleHere::class => FilterEnterTitleHereFactory::class,
                ],
            ],
        ];
    }
}
