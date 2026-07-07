# Deploying The Boven Foundation to Vercel

Vercel does **not** run Laravel like a normal PHP server. This project uses the [vercel-php](https://github.com/vercel-community/php) serverless runtime: each request boots PHP in a short-lived function.

**Important:** Render (Docker) is the better fit for a full Laravel app. Use Vercel if you specifically want Vercel’s CDN, preview deploys, or already use it for other projects.

---

## What you need

1. A **GitHub** repo with this code pushed
2. A **Vercel** account — [vercel.com](https://vercel.com)
3. A **hosted PostgreSQL** database (Vercel does not provide one). Good free options:
   - [Neon](https://neon.tech) (recommended with Vercel)
   - [Supabase](https://supabase.com)
   - Render PostgreSQL (use the **External** connection URL)

SQLite will **not** work on Vercel (no persistent disk).

---

## Repo setup (already done)

These files are in `laravel-app/`:

| File | Purpose |
|------|---------|
| `vercel.json` | Routes all traffic through `server.php` + PHP runtime |
| `server.php` | Serves `/public` assets, then boots Laravel |
| `.vercelignore` | Excludes `vendor/`, `node_modules/` (rebuilt on deploy) |
| `composer.json` → `vercel` script | Builds Vite assets, runs migrations + seeders |

---

## Step 1: Create a PostgreSQL database

### Option A — Neon (recommended)

1. Sign up at [neon.tech](https://neon.tech)
2. Create a project (e.g. `boven-foundation`)
3. Copy the **connection string** (starts with `postgresql://` or `postgres://`)

### Option B — Supabase / Render

Use the **external/public** connection URL so Vercel’s servers can reach it.

---

## Step 2: Generate your app key (locally)

```bash
cd laravel-app
php artisan key:generate --show
```

Copy the `base64:...` output — you’ll set it as `APP_KEY` on Vercel.

---

## Step 3: Import the project on Vercel

1. Go to [vercel.com/new](https://vercel.com/new)
2. **Import** your GitHub repository (`The_Boven_Foundation`)
3. Configure the project:

| Setting | Value |
|---------|--------|
| **Framework Preset** | Other |
| **Root Directory** | `laravel-app` |
| **Build Command** | leave empty (handled by `vercel-php` + `composer vercel`) |
| **Output Directory** | leave empty |
| **Install Command** | leave empty |

4. **Do not deploy yet** — add environment variables first (Step 4).

---

## Step 4: Environment variables

In Vercel → your project → **Settings** → **Environment Variables**, add:

| Key | Value |
|-----|--------|
| `APP_KEY` | Output from `php artisan key:generate --show` |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://your-project.vercel.app` (update after first deploy if needed) |
| `DB_CONNECTION` | `pgsql` |
| `DATABASE_URL` | Your Neon/Supabase/Render PostgreSQL URL |
| `SESSION_DRIVER` | `database` |
| `CACHE_STORE` | `database` |
| `QUEUE_CONNECTION` | `sync` |
| `LOG_CHANNEL` | `stderr` |

Optional (email in production):

| Key | Value |
|-----|--------|
| `MAIL_MAILER` | `smtp` |
| `MAIL_HOST` | e.g. `smtp.gmail.com` |
| `MAIL_PORT` | `587` |
| `MAIL_USERNAME` | your SMTP user |
| `MAIL_PASSWORD` | your SMTP password / app password |
| `MAIL_FROM_ADDRESS` | e.g. `bovenfoundation@gmail.com` |
| `MAIL_NOTIFY_TO` | where contact/donation alerts go |

Apply variables to **Production**, **Preview**, and **Development**.

---

## Step 5: Deploy

1. Click **Deploy** (or push to `main` if auto-deploy is on)
2. First build takes **3–8 minutes** (Composer + npm + Vite + migrations)
3. Open `https://your-project.vercel.app`

If the build fails with a Composer cache error, add:

| Key | Value |
|-----|--------|
| `VERCEL_FORCE_NO_BUILD_CACHE` | `1` |

---

## Step 6: Verify

- [ ] Homepage loads with styles and Vue sections
- [ ] Team and Projects sections show data (seeded on deploy)
- [ ] Contact form submits without error
- [ ] Donation form submits without error
- [ ] `/admin/donations` loads

Check **Deployments → Logs** if anything fails.

---

## Limitations vs Render

| Feature | Vercel | Render (Docker) |
|---------|--------|-----------------|
| Long-running PHP | No (serverless) | Yes |
| Queue workers | No — use `sync` | Yes |
| Cron / scheduled tasks | Vercel Cron (Pro) or external | Yes |
| Cold starts | Yes (~1–3s) | Minimal on paid tier |
| Persistent local files | No | Yes |
| Native Laravel support | Community workaround | First-class via Docker |

---

## Troubleshooting

### Build fails on `composer install`
- Confirm **Root Directory** is `laravel-app`
- Set `VERCEL_FORCE_NO_BUILD_CACHE=1` and redeploy

### 500 error / blank page
- Check deployment **Functions** logs
- Confirm `APP_KEY` and `DATABASE_URL` are set
- Ensure the DB URL is **external** (reachable from Vercel, not `localhost`)

### CSS/JS missing
- Redeploy — the `vercel` script runs `npm run build`
- Check logs for npm/Vite errors

### Database connection error
- `DB_CONNECTION` must be `pgsql`
- Neon/Supabase URLs often need `?sslmode=require` — use the full string from the provider

### Team/Projects empty
- Redeploy to re-run `db:seed --force`
- Or run migrations/seed manually against your hosted DB

### Contact form times out on email
- Use SMTP with short timeouts, or `MAIL_MAILER=log` until SMTP is configured

---

## CLI deploy (optional)

```bash
npm i -g vercel
cd laravel-app
vercel login
vercel --prod
```

Set env vars in the Vercel dashboard before `--prod`.

---

## Summary checklist

- [ ] PostgreSQL created (Neon/Supabase/Render)
- [ ] Code pushed to GitHub
- [ ] Vercel project imported with **Root Directory** = `laravel-app`
- [ ] Env vars set: `APP_KEY`, `APP_URL`, `DATABASE_URL`, `DB_CONNECTION=pgsql`
- [ ] Deploy and test the live URL
