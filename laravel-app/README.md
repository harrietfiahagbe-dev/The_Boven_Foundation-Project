# The Boven Foundation — Website

Laravel (API) + Vue 3 (SPA) single-page NGO site. Content is driven by the database and API.

## Requirements

- PHP 8.2+
- Composer
- Node.js 18+
- SQLite (default) or MySQL

## Setup

```bash
# Install PHP dependencies
composer install

# Install frontend dependencies
npm install

# Copy environment and generate key
cp .env.example .env
php artisan key:generate

# Database (SQLite by default)
php artisan migrate
php artisan db:seed

# Build frontend (or use npm run dev while developing)
npm run build
```

## Run locally

```bash
# Terminal 1: Laravel
php artisan serve

# Terminal 2 (optional, for hot reload during dev)
npm run dev
```

Open [http://localhost:8000](http://localhost:8000).

## API endpoints

- `GET /api/settings` — Site copy (hero, about, mission, etc.)
- `GET /api/team` — Team members
- `GET /api/projects` — Projects
- `GET /api/stats` — Impact statistics
- `POST /api/contact` — Contact form (name, email, subject, message)

## Project layout

- **Backend:** `app/Http/Controllers/`, `app/Models/`, `routes/api.php`, `database/migrations/`, `database/seeders/`
- **Frontend:** `resources/js/App.vue`, `resources/js/components/*.vue`
- **Entry:** `resources/views/welcome.blade.php` loads the Vue app; `routes/web.php` serves it at `/`.

## Content

Seed data includes PRD content: team (4 members), projects (3), and site settings (hero, about, mission, values, contact). Replace placeholder images and add partner logos as needed.
