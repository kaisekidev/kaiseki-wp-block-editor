# kaiseki/wp-block-editor

WordPress block editor (Gutenberg) helpers: block categories, editor and block-type toggles, embed variations.

A set of small hook providers that configure the block editor from a single `block_editor` config key.
Each feature is a `kaiseki/wp-hook` `HookProviderInterface` wired through `ConfigProvider`, so you
enable it by adding its config and registering the provider — no manual `add_filter` plumbing.

## Installation

```bash
composer require kaiseki/wp-block-editor
```

Requires PHP 8.2 or newer.

## Usage

Register `ConfigProvider` with your laminas-style config aggregator, then drive the features from the
`block_editor` config key:

```php
use Kaiseki\WordPress\BlockEditor\DisableBlockEditor\DisableBlockEditor;
use Kaiseki\WordPress\BlockEditor\EnterTitleHere\EnterTitleHereFilter;

return [
    'block_editor' => [
        // Register custom block categories (classes implementing BlockCategoryInterface).
        'add_categories_at_top' => false,
        'categories' => [
            MyBlockCategory::class,
        ],
        // Fall back to the classic editor for specific post types or via callables.
        'disable_block_editor' => [
            'post_types' => ['product'],
            'post_filter' => [],
        ],
        // Enable/disable individual core embed block variations.
        'embed_variations' => [
            'disable' => ['tiktok'],
            'enable' => [],
        ],
        // Override the "Enter title here" placeholder per post type.
        'enter_title_here' => [
            'page' => 'Enter page name',
        ],
    ],
    // Activate the providers you use via kaiseki/wp-hook.
    'hook' => [
        'provider' => [
            DisableBlockEditor::class,
            EnterTitleHereFilter::class,
        ],
    ],
];
```

`ConfigProvider` registers factories for every feature (`BlockCategoriesRegistry`, `UnregisterBlockTypes`,
`DisableBlockEditor`, `DisableEmbedVariations`, `EnableEmbedVariations`, `EnterTitleHereFilter`), each
reading its slice of the `block_editor` config from the container.

### Custom block categories

Implement `BlockCategoryInterface` and add the class to `block_editor.categories`:

```php
use Kaiseki\WordPress\BlockEditor\BlockCategories\BlockCategoryInterface;

final class MyBlockCategory implements BlockCategoryInterface
{
    public function getSlug(): string { return 'my-blocks'; }
    public function getTitle(): string { return 'My Blocks'; }
    public function getIcon(): ?string { return null; }
    public function beforeSlug(): string { return ''; }
    public function afterSlug(): string { return ''; }
}
```

## Development

```bash
composer install
composer check   # check-deps, cs-check, phpstan
```

## License

MIT — see [LICENSE](LICENSE).
