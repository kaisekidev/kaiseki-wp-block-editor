<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor\DisableBlockEditor;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

use function array_reduce;
use function class_exists;
use function is_callable;
use function is_object;
use function is_string;

final class DisableBlockEditorFactory
{
    public function __invoke(ContainerInterface $container): DisableBlockEditor
    {
        $config = Config::fromContainer($container);
        /** @var list<string> $postTypes */
        $postTypes = $config->array('block_editor.disable_block_editor.post_types');
        /** @var list<callable> $postFilter */
        $postFilter = array_reduce(
            $config->array('block_editor.disable_block_editor.post_filter'),
            static function (array $carry, mixed $filter) use ($container) {
                if (is_callable($filter) || is_object($filter)) {
                    $carry[] = $filter;
                }
                if (is_string($filter) && class_exists($filter)) {
                    $carry[] = Config::initClass($container, $filter);
                }

                return $carry;
            },
            []
        );

        return new DisableBlockEditor($postTypes, $postFilter);
    }
}
