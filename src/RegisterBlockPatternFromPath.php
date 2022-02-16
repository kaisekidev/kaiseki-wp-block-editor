<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;
use WP_Block_Patterns_Registry;

use function add_filter;
use function basename;
use function register_block_pattern;
use function Safe\glob;
use function str_replace;

final class RegisterBlockPatternFromPath implements HookCallbackProviderInterface
{
    /** @var list<array{path: string, namespace: string}> */
    private array $paths;

    /**
     * @param list<array{path: string, namespace: string}> $paths
     */
    public function __construct(array $paths)
    {
        $this->paths = $paths;
    }

    public function registerCallbacks(): void
    {
        add_filter('init', [$this, '__invoke']);
    }

    public function __invoke(): void
    {
        foreach ($this->paths as $path) {
            $this->registerBlockPattern($path['path'], $path['namespace']);
        }
    }

    private function registerBlockPattern(string $path, string $namespace): void
    {
        foreach (glob($path . '*.php') as $filePath) {
            $fileName = str_replace('.php', '', basename($filePath));
            $patternName = "$namespace/$fileName";
            if (WP_Block_Patterns_Registry::get_instance()->is_registered($patternName)) {
                continue;
            }
            register_block_pattern($patternName, require $filePath);
        }
    }
}
