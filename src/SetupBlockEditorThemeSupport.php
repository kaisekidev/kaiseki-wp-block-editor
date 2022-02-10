<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\BlockEditor;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

use function count;

final class SetupBlockEditorThemeSupport implements HookCallbackProviderInterface
{
    private bool $alignWide;
    private bool $customLineHeight;
    private bool $customSpacing;
    private bool $disableCustomUnits;
    /** @var list<string> */
    private array $customUnits;
    private bool $disableColors;
    private bool $disableCustomColors;
    private bool $disableFontSizes;
    private bool $disableCustomFontSizes;
    private bool $disableGradients;
    private bool $disableCustomGradients;
    /** @var list<array{name: string, slug: string, color: string}> */
    private array $editorColorPalette;
    /** @var list<array{name: string, size: int, slug: string}> */
    private array $editorFontSizes;
    /** @var list<array{name: string, gradient: string, slug: string}> */
    private array $editorGradientPresets;
    private bool $editorStyles;
    private bool $removeCoreBlockPatterns;
    private bool $responsiveEmbeds;
    private bool $wpBlockStyles;

    /**
     * @param list<string> $customUnits
     * @param list<array{name: string, slug: string, color: string}> $editorColorPalette
     * @param list<array{name: string, size: int, slug: string}> $editorFontSizes
     * @param list<array{name: string, gradient: string, slug: string}> $editorGradientPresets
     */
    public function __construct(
        bool $alignWide,
        bool $customLineHeight,
        bool $customSpacing,
        bool $disableCustomUnits,
        array $customUnits,
        bool $disableColors,
        bool $disableCustomColors,
        bool $disableFontSizes,
        bool $disableCustomFontSizes,
        bool $disableGradients,
        bool $disableCustomGradients,
        array $editorColorPalette,
        array $editorFontSizes,
        array $editorGradientPresets,
        bool $editorStyles,
        bool $removeCoreBlockPatterns,
        bool $responsiveEmbeds,
        bool $wpBlockStyles
    ) {
        $this->alignWide = $alignWide;
        $this->customLineHeight = $customLineHeight;
        $this->customSpacing = $customSpacing;
        $this->customUnits = $customUnits;
        $this->disableCustomUnits = $disableCustomUnits;
        $this->disableColors = $disableColors;
        $this->disableCustomColors = $disableCustomColors;
        $this->disableFontSizes = $disableFontSizes;
        $this->disableCustomFontSizes = $disableCustomFontSizes;
        $this->disableGradients = $disableGradients;
        $this->disableCustomGradients = $disableCustomGradients;
        $this->editorColorPalette = $editorColorPalette;
        $this->editorFontSizes = $editorFontSizes;
        $this->editorGradientPresets = $editorGradientPresets;
        $this->editorStyles = $editorStyles;
        $this->removeCoreBlockPatterns = $removeCoreBlockPatterns;
        $this->responsiveEmbeds = $responsiveEmbeds;
        $this->wpBlockStyles = $wpBlockStyles;
    }

    public function registerCallbacks(): void
    {
        add_action('after_setup_theme', [$this, 'setupThemeSupportForBlocks']);
    }

    public function setupThemeSupportForBlocks(): void
    {
        $this
            ->setThemeSupport('align-wide', $this->alignWide)
            ->setThemeSupport('custom-line-height', $this->customLineHeight)
            ->setThemeSupport('custom-spacing', $this->customSpacing)
            ->setThemeSupport('disable-colors', $this->disableColors)
            ->setThemeSupport('disable-custom-colors', $this->disableCustomColors)
            ->setThemeSupport('disable-font-sizes', $this->disableFontSizes)
            ->setThemeSupport('disable-custom-font-sizes', $this->disableCustomFontSizes)
            ->setThemeSupport('disable-gradients', $this->disableGradients)
            ->setThemeSupport('disable-custom-gradients', $this->disableCustomGradients)
            ->setThemeSupport('editor-styles', $this->editorStyles)
            ->setThemeSupport('responsive-embeds', $this->responsiveEmbeds)
            ->setThemeSupport('wp-block-styles', $this->wpBlockStyles);
        $this
            ->setThemeSupportWithArgs(
                'custom-units',
                $this->customUnits,
                $this->disableCustomUnits
            )
            ->setThemeSupportWithArgs(
                'editor-color-palette',
                $this->editorColorPalette,
                $this->disableColors
            )
            ->setThemeSupportWithArgs(
                'editor-font-sizes',
                $this->editorFontSizes,
                $this->disableFontSizes
            )
            ->setThemeSupportWithArgs(
                'editor-gradient-presets',
                $this->editorGradientPresets,
                $this->disableGradients
            );
        if ($this->removeCoreBlockPatterns !== true) {
            return;
        }

        remove_theme_support('core-block-patterns');
    }

    private function setThemeSupport(string $feature, bool $args): self
    {
        if ($args !== true) {
            return $this;
        }
        add_theme_support($feature);
        return $this;
    }

    /**
     * @param array<mixed> $args
     */
    private function setThemeSupportWithArgs(string $feature, array $args, bool $disable = false): self
    {
        if ($disable === true) {
            add_theme_support($feature, []);
            return $this;
        }
        if (count($args) < 1) {
            return $this;
        }
        add_theme_support($feature, $args);
        return $this;
    }
}
