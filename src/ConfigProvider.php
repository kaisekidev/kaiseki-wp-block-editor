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
            'block_editor' => [
                'theme_support' => [
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment
                    'align_wide' => false,
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#supporting-custom-line-heights
                    'custom_line_height' => false,
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#spacing-control
                    'custom_spacing' => false,
                    // Disable support for custom units
                    'disable_custom_units' => false,
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#support-custom-units
                    'custom_units' => [],
                    // Disable colors altogether and ignore custom editor_color_palette config
                    'disable_colors' => false,
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-custom-colors-in-block-color-palettes
                    'disable_custom_colors' => false,
                    // Disable font sizes altogether and ignore custom editor_font_sizes config
                    'disable_font_sizes' => false,
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-custom-font-sizes
                    'disable_custom_font_sizes' => false,
                    // Disable gradients altogether and ignore custom editor_gradient_presets config
                    'disable_gradients' => false,
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-custom-gradients
                    'disable_custom_gradients' => false,
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-color-palettes
                    'editor_color_palette' => [
                        // [
                        //     'name'  => esc_attr__('Yellow', 'kaiseki'),
                        //     'color'  => '#f4c468',
                        //     'slug'  => 'yellow',
                        // ],
                    ],
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-font-sizes
                    'editor_font_sizes' => [
                        // [
                        //    'name' => esc_attr__( 'Small', 'kaiseki' ),
                        //    'size' => 12,
                        //    'slug' => 'small'
                        // ],
                    ],
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-gradient-presets
                    'editor_gradient_presets' => [
                        // [
                        //     'name'     => esc_attr__('Gradient', 'kaiseki'),
                        //     'gradient' => 'linear-gradient(166deg, rgb(244, 196, 104) 0%, rgb(0, 0, 0) 100%)',
                        //     'slug'     => 'gradient',
                        // ],
                    ],
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#editor-styles
                    'editor_styles' => false,
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
                    'remove_core_block_patterns' => false,
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#responsive-embedded-content
                    'responsive_embeds' => false,
                    // https://developer.wordpress.org/block-editor/developers/themes/theme-support/#editor-styles
                    'wp_block_styles' => false,
                ],
                /**
                 * Add new block categories to the default list of categories
                 *
                 * @link https://developer.wordpress.org/reference/hooks/block_categories/
                 */
                'categories' => [
                    // [
                    //     'slug' => 'kaiseki',
                    //     'title' => __('Custom blocks by kaiseki', 'kaiseki'),
                    //     'icon'  => null,
                    // ],
                ],
                /**
                 * No changes will be made for post types not used in any of the config groups.
                 * You can use post types in multiple config groups in which case block types will be merged.
                 *
                 * @link https://developer.wordpress.org/reference/hooks/allowed_block_types/
                 *
                 * To get a list of all available block types open the block editor in your browser and paste this
                 * JavaScript code into your console in order to save an array of all block types in your clipboard:
                 * copy(wp.blocks.getBlockTypes().map(type => type.name));
                 */
                'allowed_block_types' => [
                    /**
                     * Example config group targeting posts and pages.
                     */
                    // [
                    //     'post_types' => [
                    //         'post',
                    //         'page',
                    //     ],
                    //     'block_types' => [
                    //         'core/paragraph',
                    //         'core/image',
                    //         'core/heading',
                    //         'core/gallery',
                    //         'core/list',
                    //         'core/quote',
                    //         'core/shortcode',
                    //         'core/archives',
                    //         'core/audio',
                    //         'core/button',
                    //         'core/buttons',
                    //         'core/calendar',
                    //         'core/categories',
                    //         'core/code',
                    //         'core/columns',
                    //         'core/column',
                    //         'core/cover',
                    //         'core/embed',
                    //         'core/file',
                    //         'core/group',
                    //         'core/freeform',
                    //         'core/html',
                    //         'core/media-text',
                    //         'core/latest-posts',
                    //         'core/missing',
                    //         'core/more',
                    //         'core/nextpage',
                    //         'core/preformatted',
                    //         'core/pullquote',
                    //         'core/rss',
                    //         'core/search',
                    //         'core/separator',
                    //         'core/block',
                    //         'core/social-links',
                    //         'core/social-link',
                    //         'core/spacer',
                    //         'core/subhead',
                    //         'core/table',
                    //         'core/tag-cloud',
                    //         'core/text-columns',
                    //         'core/verse',
                    //         'core/video'
                    //     ],
                    // ],
                ],
                /**
                 * Allow usage of only specific embed variations.
                 *
                 * To get a list of all available embed variations open the block editor in your browser and paste this
                 * JavaScript code into your console in order to save an array of all variations in your clipboard:
                 * copy(wp.blocks.getBlockVariations("core/embed").map(variation => variation.name));
                 */
                'allowed_embed_variations' => [
                    // 'amazon-kindle',
                    // 'animoto',
                    // 'cloudup',
                    // 'collegehumor',
                    // 'crowdsignal',
                    // 'dailymotion',
                    // 'facebook',
                    // 'flickr',
                    // 'imgur',
                    // 'instagram',
                    // 'issuu',
                    // 'kickstarter',
                    // 'meetup-com',
                    // 'mixcloud',
                    // 'polldaddy',
                    // 'reddit',
                    // 'reverbnation',
                    // 'screencast',
                    // 'scribd',
                    // 'slideshare',
                    // 'smugmug',
                    // 'soundcloud',
                    // 'speaker',
                    // 'speaker-deck',
                    // 'spotify',
                    // 'ted',
                    // 'tiktok',
                    // 'tumblr',
                    // 'twitter',
                    // 'videopress',
                    // 'vimeo',
                    // 'wordpress',
                    // 'wordpress-tv',
                    // 'youtube',
                ],
                /**
                 * Disable block editor for specified post types.
                 *
                 * @link https://developer.wordpress.org/reference/hooks/use_block_editor_for_post_type/
                 */
                'disable_for_post_types' => [
                    // EmployeePostType::NAME,
                ],
                /**
                 * Disable block editor for certain posts by running them through checkers.
                 * Checkers must implement PostCheckerInterface.
                 *
                 * @link https://developer.wordpress.org/reference/hooks/use_block_editor_for_post/
                 */
                'disable_for_posts' => [
                    // FrontPagePostChecker::class
                ],
                /**
                 * Replace the title field placeholder text.
                 * Configure via array of texts keyed by post types.
                 *
                 * @link https://developer.wordpress.org/reference/hooks/enter_title_here/
                 */
                'title_input_placeholder' => [
                    // EmployeePostType::NAME => __('Enter name here', 'kaiseki'),
                ],
                // Class names used by Block Content Filters
                'block_classes' => [
                    /**
                     * Used by ListBlockClassStringFilter.
                     * Defaults to 'block-heading' if not set.
                     */
                    'heading' => '',
                    /**
                     * Used by HeadingBlockClassStringFilter.
                     * Defaults to 'block-list' if not set.
                     */
                    'list' => '',
                    /**
                     * Used by ParagraphBlockClassStringFilter.
                     * Defaults to 'block-paragraph' if not set.
                     */
                    'paragraph' => '',
                ],
            ],
            'dependencies' => [
                'aliases' => [],
                'factories' => [
                    AddBlockCategories::class => AddBlockCategoriesFactory::class,
                    ConfigureAllowedBlockTypes::class => ConfigureAllowedBlockTypesFactory::class,
                    DisableBlockEditorForPostTypes::class => DisableBlockEditorForPostTypesFactory::class,
                    DisableBlockEditorForPosts::class => DisableBlockEditorForPostsFactory::class,
                    DisableEmbedVariations::class => DisableEmbedVariationsFactory::class,
                    ReplaceBlockEditorTitleInputPlaceholder::class
                        => ReplaceBlockEditorTitleInputPlaceholderFactory::class,
                    SetupBlockEditorThemeSupport::class => SetupBlockEditorThemeSupportFactory::class,
                ],
            ],
        ];
    }
}
