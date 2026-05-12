# AGENTS.md - BBLBA Dashboard

## Project Overview
- **Type**: Laravel 8 PHP application (PHP ^7.3|^8.0)
- **Database**: MySQL (`dashboardbblba`)
- **Frontend**: Laravel Mix (basic asset compilation)

## Setup
```bash
composer install              # Install PHP dependencies
cp .env.example .env          # Copy environment config
php artisan key:generate      # Generate app key
php artisan migrate           # Run database migrations
npm install                   # Install JS dependencies
```

## Developer Commands

```bash
# PHP/Laravel
php artisan serve             # Start development server
php artisan migrate           # Run migrations
php artisan db:seed           # Seed database

# Frontend assets
npm run dev                   # Compile assets for development
npm run watch                 # Watch for changes
npm run prod                  # Production build

# Tests
./vendor/bin/phpunit          # Run all tests
```

## Architecture

- **Admin routes**: `/admin301097` (protected by `admin.auth` middleware)
- **Public routes**: Certificate generation (`/sertifikat*`), scheduling (`/jadwaltuweb*`), attendance (`/absensi-monitoring`), graduation tables (`/mejaijazah`)
- **Entry point**: `artisan` CLI, routes defined in `routes/web.php`

## Key Directories
- `app/Http/Controllers/` - All controllers (Admin, Certificate, etc.)
- `app/Models/` - Eloquent models
- `app/Services/` - Business logic
- `app/Exports/` & `app/Imports/` - Excel import/export (maatwebsite/excel)
- `config/` - Laravel config (including custom `srs.php` for external API)

## External Integrations
- **Google Drive**: Uses `nao-pon/flysystem-google-drive` for cloud storage
- **SRS API**: External API at `config/srs.php` (api-mahasiswa-srs.ut.ac.id)
- **Email**: Gmail SMTP (configured in `.env`)

## Database
- MySQL with existing dump: `dashboard_bblba.sql`
- Uses Yajra DataTables for admin interfaces

## Notes
- **Two auth systems**: `admin.auth` for admin routes (`/admin301097`), `auth` for employee attendance (`/absensi-monitoring`)
- Multiple certificate systems: legacy (PKBJJ, OSMB, WTKU, Seminar) and new event-based system
- Google credentials stored in `storage/app/google-credentials.json`
- **Critical**: `.env` must contain valid credentials for Google Drive, SRS API, and SMTP for full functionality