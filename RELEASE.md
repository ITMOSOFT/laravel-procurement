# Release instructions

- Repository: `ITMOSOFT/laravel-procurement`
- Composer package: `itmosoft/laravel-procurement`
- Initial tag: `v1.0.0`

## Validate locally

```bash
composer validate --strict
composer install
composer test
```

## User-run Git commands

Run these yourself after local tests pass and GitHub Actions succeeds:

```bash
git add .
git commit -m "chore: prepare procurement v1.0.0"
git push origin main
git tag -a v1.0.0 -m "Release v1.0.0"
git push origin v1.0.0
```

## GitHub Release

Title: `v1.0.0 — Initial Release`

Description:

```markdown
## Highlights

- Polymorphic requester and optional company/account owner.
- Procurement request reference, purpose, needed-by date and currency.
- Draft, submitted, approved, rejected and cancelled lifecycle.
- Request line items with quantity and estimated unit cost.
- Reviewer identity, decision notes and timestamps.
- Optional purchase-order reference for downstream handoff.

## Requirements

- PHP 8.3+
- Laravel 12 or 13

## Installation

composer require itmosoft/laravel-procurement
php artisan migrate

```

## Packagist

Submit the public repository at https://packagist.org/packages/submit and verify that Packagist detects `v1.0.0`.
