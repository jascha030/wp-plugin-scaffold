# Agent Instructions

## Project

Symfony Console CLI application. Runtime entrypoint is `bin/wp-plugin-scaffold`.

- PSR-4 namespace: `Jascha030\WpPluginScaffold`
- Source: `src/`
- Tests: `tests/`
- New commands go in `src/Command/`, are registered in `src/Application.php` via `addCommand()`.

## Environment

- PHP `>=8.4`
- Composer `^2.2`

## Daily commands

```bash
composer install          # also installs vendor-bin/php-cs-fixer via bamarni forward
composer run test         # installs phive tools, runs PHPUnit with coverage
composer run analyze      # installs tools, runs PHPStan at max level
composer run format       # runs php-cs-fixer
composer validate --strict && composer normalize --dry-run
```

Focused test run without coverage:

```bash
XDEBUG_MODE=off tools/phpunit.phar --filter CreateTest
```

## Tooling quirks

- **PHPUnit** is installed by **phive** into `tools/phpunit.phar`. `composer run tools:install` fetches phive if missing and installs it.
- **php-cs-fixer** is isolated in `vendor-bin/php-cs-fixer/` via `bamarni/composer-bin-plugin`. Its autoloader is required by `.php-cs-fixer.dist.php` and by `phpstan.neon.dist`.
- **PHPStan** runs at level `max` against `src/`, `tests/`, and `tools/`. It bootstraps `tools/phpunit.phar` and `vendor-bin/php-cs-fixer/vendor/autoload.php`.
- PHPUnit requires coverage metadata (`requireCoverageMetadata="true"`) — every test class needs `#[CoversClass(...)]` or `@covers`.

## Adding a console command

1. Create `final class Foo extends Command` in `src/Command/`.
2. Use `#[AsCommand(name: 'foo', description: '...')]`.
3. Add it in `src/Application.php::__construct()` with `$this->addCommand(new Foo());`.

Note: `Application::add()` is deprecated in Symfony 7.4; use `addCommand()`.

## CI order

`.github/workflows/ci.yml` runs:

1. `composer validate --strict`
2. `composer normalize --dry-run`
3. `composer run format -- --dry-run --diff`
4. `composer run analyze`
5. `composer run test`

Run the same sequence locally before pushing.
