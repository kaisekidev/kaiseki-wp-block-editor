<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Config\Config;
use Psr\Container\ContainerInterface;

final class SetupBlockEditorThemeSupportFactory
{
    public function __invoke(ContainerInterface $container): SetupBlockEditorThemeSupport
    {
        $config = Config::get($container);
        /** @var list<string> $customUnits */
        $customUnits = $config->array('block_editor/theme_support/custom_units');
        /** @var list<array{name: string, slug: string, color: string}> $editorColorPalette */
        $editorColorPalette = $config->array('block_editor/theme_support/editor_color_palette');
        /** @var list<array{name: string, size: int, slug: string}> $editorFontSizes */
        $editorFontSizes = $config->array('block_editor/theme_support/editor_font_sizes');
        /** @var list<array{name: string, gradient: string, slug: string}> $editorGradientPresets */
        $editorGradientPresets = $config->array('block_editor/theme_support/editor_gradient_presets');
        return new SetupBlockEditorThemeSupport(
            $config->bool('block_editor/theme_support/align_wide'),
            $config->bool('block_editor/theme_support/custom_line_height'),
            $config->bool('block_editor/theme_support/custom_spacing'),
            $config->bool('block_editor/theme_support/disable_custom_units'),
            $customUnits,
            $config->bool('block_editor/theme_support/disable_colors'),
            $config->bool('block_editor/theme_support/disable_custom_colors'),
            $config->bool('block_editor/theme_support/disable_font_sizes'),
            $config->bool('block_editor/theme_support/disable_custom_font_sizes'),
            $config->bool('block_editor/theme_support/disable_gradients'),
            $config->bool('block_editor/theme_support/disable_custom_gradients'),
            $editorColorPalette,
            $editorFontSizes,
            $editorGradientPresets,
            $config->bool('block_editor/theme_support/editor_styles'),
            $config->bool('block_editor/theme_support/remove_core_block_patterns'),
            $config->bool('block_editor/theme_support/responsive_embeds'),
            $config->bool('block_editor/theme_support/wp_block_styles'),
        );
    }
}
