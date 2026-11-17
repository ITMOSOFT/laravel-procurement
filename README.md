# ITMOSOFT Laravel Procurement

Procurement request and approval workflow primitives for Laravel applications, with polymorphic requesters, line items, review decisions, and purchase-order handoff references.

## Features

- Polymorphic requester and optional company/account owner
- Procurement request reference, purpose, needed-by date and currency
- Draft, submitted, approved, rejected and cancelled lifecycle
- Request line items with quantity and estimated unit cost
- Reviewer identity, decision notes and timestamps
- Optional purchase-order reference for downstream handoff

## Requirements

- PHP 8.3+
- Laravel 12 or 13

## Installation

```bash
composer require itmosoft/laravel-procurement
php artisan vendor:publish --tag=procurement-config
php artisan migrate
```

## Usage

Use the package's Eloquent model under `ITMOSOFT\\Procurement\\Models\\ProcurementRequest`. Create records with the required polymorphic relation fields and use the model lifecycle methods documented below.

### Lifecycle methods

- `submit()` submits a draft request.
- `approve($reviewer, $notes)` approves a submitted request.
- `reject($reviewer, $notes)` rejects a submitted request.
- `cancel()` cancels draft, submitted, or approved requests.

## Important boundaries

This package provides persistence models and lifecycle primitives. It does not provide authentication, authorization, approval routing, notifications, file uploads, electronic signatures, payment processing, or tenant isolation. Enforce permissions and business-specific validation in the host application. File paths and document metadata are references only; implement secure upload, storage, access control, and malware scanning in the application.

## Testing

```bash
composer install
composer test
```

## License

MIT.
