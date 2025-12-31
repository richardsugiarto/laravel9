# Multilingual Article CMS (Laravel 9)

This repository contains a Laravel 9 application providing a multilingual article/content management backend and public-facing site. It includes an admin area, user authentication (Fortify), article translations, and API endpoints.

**What the app does**
- Provides CRUD for articles with multi-language support (Article + ArticleTranslation).
- Serves localized public content and admin management interfaces.
- Supports user authentication, two-factor login, social/google login integration (via `google_id`), and API tokens.

**Features**
- Multilingual content: articles have translations stored in a separate table.
- Admin panel and admin tables (see migrations) for managing content and users.
- Authentication: email/password, two-factor, Google sign-in support, password resets, and API tokens (Sanctum / personal access tokens present in migrations).
- Routes split between web and API for clear separation of concerns.

**Tech stack**
- PHP 8+ and Laravel 9
- Eloquent ORM for database access
- Blade for server-rendered views (where used)
- Migrations / seeders for schema and sample data
- Frontend: basic JS/CSS in `resources/js` and `resources/css` (build with Mix)
- Database: MySQL / MariaDB (or any supported by Laravel)

**Auth flow (overview)**
- Authentication is implemented with Laravel Fortify. User actions and customizations are organized under `app/Actions/Fortify` and Fortify-related config in `config/fortify.php`.
- Common flows:
	- Registration / Login: Fortify routes handle credential validation and session management.
	- Two-Factor: additional columns and migrations for two-factor support are present; Fortify handles challenge and verification.
	- Social login: a `google_id` column was added by migration to support linking Google accounts.
	- Password reset and personal access tokens are supported via standard Laravel migrations (`password_resets`, `personal_access_tokens`).

**Database schema (high-level)**
- `users` — standard user fields plus two-factor columns and `google_id` (see migration `2022_04_25_add_google_id_column.php`).
- `articles` — main article records (status, slug, publish timestamps, etc.). See migration `2022_04_26_create_articles_table.php`.
- `article_translations` — language-specific fields (title, content, locale) linked to `articles` via `article_id` (see `2022_05_05_create_articletranslations_table.php`).
- Other tables: `password_resets`, `personal_access_tokens`, and admin-related tables created by `2016_01_04_create_admin_tables.php`.

The schema is intentionally normalized for translations: core article metadata is in `articles`, and per-locale content is in `article_translations`.

**Routing → Controller → Model (how it works here)**
- Routes: HTTP endpoints are declared in `routes/web.php` (web UI) and `routes/api.php` (API). These map HTTP verbs and URIs to controller actions.
- Controller: Controller classes live in [app/Http/Controllers](app/Http/Controllers). A route such as `/articles` points to a controller method (e.g., `ArticleController@index`) which orchestrates request handling.
- Model: Models are in [app/Models](app/Models) (for example `Article.php`, `ArticleTranslation.php`, and `User.php`). Controllers use Eloquent models to query and mutate data:
	- Example flow: an HTTP GET to `/articles` (route) → `ArticleController@index` (controller) → `Article::with('translations')->where(...)->get()` (model query) → controller returns a view or JSON response.

**Where to look in the codebase**
- Routes: [routes/web.php](routes/web.php) and [routes/api.php](routes/api.php)
- Controllers: [app/Http/Controllers](app/Http/Controllers)
- Models: [app/Models/Article.php](app/Models/Article.php), [app/Models/ArticleTranslation.php](app/Models/ArticleTranslation.php), [app/Models/User.php](app/Models/User.php)
- Auth customizations and Fortify actions: [app/Actions/Fortify](app/Actions/Fortify)
- Config: `config/fortify.php`, `config/translatable.php` (localization/translation-related settings)

**Setup & Run**

Prerequisites: PHP 8+, Composer, Node.js/NPM, and a database (MySQL/MariaDB recommended).

1. Clone and install dependencies

```bash
git clone <repo-url> my-project
cd my-project
composer install
npm install
```

2. Environment

```bash
cp .env.example .env
# Edit .env and set DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
php artisan key:generate
```

3. Database setup

```bash
php artisan migrate --seed
php artisan storage:link
```

4. Frontend build

```bash
npm run dev   # or `npm run build` / `npm run prod` for production
```

5. Run the app (local dev)

```bash
php artisan serve
# Open http://127.0.0.1:8000 in your browser
```

6. Optional / helpful commands

```bash
php artisan migrate:fresh --seed   # reset DB and reseed
php artisan queue:work             # start queue worker if using background jobs
php artisan test                   # run test suite
```

7. Social/Google login (if used)

- Add OAuth credentials to `.env`: `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, and `GOOGLE_REDIRECT`.
- Ensure `google_id` column is present (migration `2022_04_25_add_google_id_column.php`).

Notes:
- The application uses Fortify for authentication; review `config/fortify.php` and `app/Actions/Fortify` for customizations.
- If you use Docker or another environment, adapt the DB host/ports appropriately.

## Design Decisions

- Used a normalized translation schema (`articles` + `article_translations`) to support scalable multilingual content.
- Chose Fortify for authentication to allow customization of login, 2FA, and social auth flows.
- Kept API and web routes separate to support future headless or mobile clients.

### Example API Flow

GET /api/articles?locale=en

- Controller loads articles with translations
- Filters by requested locale
- Returns localized content as JSON
