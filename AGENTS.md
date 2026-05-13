# AGENTS.md - BBLBA Dashboard

## Quick Start
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
```

## Developer Commands

```bash
php artisan serve             # Dev server
npm run dev                   # Compile assets
npm run watch                 # Watch mode
./vendor/bin/phpunit          # Run tests
```

## Architecture

- **Admin routes**: `/admin301097` (protected by `admin.auth` middleware)
- **Public routes**: `/sertifikat*`, `/jadwaltuweb*`, `/absensi-monitoring`, `/mejaijazah`
- **Entry point**: `artisan` CLI, routes in `routes/web.php`

## Key Directories
- `app/Http/Controllers/` - Controllers
- `app/Models/` - Eloquent models
- `app/Exports/` & `app/Imports/` - Excel (maatwebsite/excel)
- `config/srs.php` - External SRS API config

## External Integrations
- **Google Drive**: `nao-pon/flysystem-google-drive`, credentials in `storage/app/google-credentials.json`
- **SRS API**: `api-mahasiswa-srs.ut.ac.id` (config/srs.php)
- **Email**: Gmail SMTP (in `.env`)

## Critical Notes
- **Two auth systems**: `admin.auth` for `/admin301097`, `auth` for `/absensi-monitoring`
- Database: MySQL (`dashboardbblba`), uses Yajra DataTables
- `.env` must have valid credentials for Google Drive, SRS API, and SMTP