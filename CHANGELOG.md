# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 1.0.0 - 2026-05-31

First tagged release.

### Added

- Block-editor (Gutenberg) hook providers wired through `ConfigProvider` under the `block_editor`
  config key: custom block categories (`BlockCategoriesRegistry` / `BlockCategoryInterface`),
  unregistering block types (`UnregisterBlockTypes`), disabling the block editor per post type or
  filter (`DisableBlockEditor`), enabling/disabling embed variations (`EnableEmbedVariations` /
  `DisableEmbedVariations`), and overriding the "Enter title here" placeholder (`EnterTitleHereFilter`).

### Changed

- PHP requirement is `^8.2` (PHP 8.4 is the primary target).
- Pinned the internal dependencies to SemVer ranges: `kaiseki/config` and `kaiseki/wp-hook`
  `dev-master` → `^2.0`.
- Adopted the org baseline: `kaiseki/php-coding-standard: ^1.0` with the shared PHPStan config
  (`level: max`), PHPStan 2, PHPUnit 11, and `composer-require-checker: ^4.0` (added a `check-deps`
  script); replaced the unbounded `>=` dev constraints with carets; CI runs via the reusable workflow
  in `kaisekidev/.github`. Static-analysis only — no test suite yet (`run-tests: false`).
