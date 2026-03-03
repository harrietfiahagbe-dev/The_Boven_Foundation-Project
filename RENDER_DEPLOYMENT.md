# Deploying The Boven Foundation to Render

Render runs PHP via **Docker only** (no native PHP runtime). This repo is set up to build and run the Laravel + Vue app in a container.

---

## Approach

1. **Runtime:** Docker (nginx + PHP-FPM).
2. **Build:** Multi-stage Docker build:
   - Stage 1: Install PHP deps (Composer), Node deps, build Vue with Vite.
   - Stage 2: Copy built app into `richarvey/nginx-php-fpm` and serve from `/public`.
3. **Database:** Use Render PostgreSQL (recommended). SQLite is possible but data is lost on redeploy (ephemeral disk).
4. **Start:** Container runs Laravel cache commands, migrations, then nginx + PHP-FPM.

---

## Steps

### 1. Push code to GitHub/GitLab

Ensure the repo (e.g. `The_Boven_Foundation`) is pushed and Render can access it.

### 2. Create a PostgreSQL database on Render

1. [Dashboard](https://dashboard.render.com) → **New +** → **PostgreSQL**.
2. Name it (e.g. `boven-db`), choose region, create.
3. Copy the **Internal Database URL** (you’ll use it as `DATABASE_URL` and for `DB_URL`).

### 3. Create a Web Service

1. **New +** → **Web Service**.
2. Connect the repo and select it.
3. **Root Directory:** set to **`laravel-app`** (so Render uses the folder that contains `Dockerfile`).
4. **Runtime:** **Docker**.
5. Leave **Build Command** and **Start Command** empty (Dockerfile defines the image and `CMD`).

### 4. Environment variables

In the Web Service → **Environment** tab, add:

| Key | Value |
|-----|--------|
| `APP_KEY` | From `php artisan key:generate --show` (run locally once). |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | Your Render URL, e.g. `https://your-service-name.onrender.com` |
| `DB_CONNECTION` | `pgsql` |
| `DATABASE_URL` | Internal Database URL from the PostgreSQL service (Render can auto-link if you add the DB as a dependency). |
| `DB_URL` | Same as `DATABASE_URL` (or leave unset; app falls back to `DATABASE_URL`). |
| `LOG_CHANNEL` | `stderr` (optional; already set in Dockerfile) |

**Optional (recommended for production):**

- `ASSET_URL` = `https://your-service-name.onrender.com` (so Vite assets load over HTTPS).

### 5. Link PostgreSQL to the Web Service (optional but useful)

1. In the Web Service → **Environment**, click **Add Environment Group** or **Link Resource**.
2. Select the PostgreSQL database. Render will inject `DATABASE_URL` automatically.
3. You still need to set `DB_CONNECTION=pgsql` and `APP_KEY`, `APP_URL`, etc.

### 6. Deploy

1. Save the Web Service. Render will build the Docker image (Composer + npm + Vite build) and then start the container.
2. First deploy can take several minutes. Later deploys are faster (cached layers).
3. When the service is **Live**, open `https://<your-service>.onrender.com`.

### 7. After first deploy

- Run seeders once if needed (e.g. via **Shell** in Render, or a one-off job):
  - `php artisan db:seed --force`
- If you use queues, add a **Background Worker** service using the same image and run `php artisan queue:work` (or use the same Dockerfile with a different start command).

---

## Detailed step-by-step (beginner)

Do these in order. Each step tells you exactly where to click and what to type.

---

### Step 2: Create a PostgreSQL database on Render

**What this is:** Your Laravel app needs a database to store data (donations, contact messages, etc.). Render will host a PostgreSQL database for you.

1. **Open Render**
   - Go to [https://dashboard.render.com](https://dashboard.render.com) and log in (or sign up with GitHub/Google).

2. **Start creating a database**
   - On the dashboard, find the green button **"New +"** (top right).
   - Click **"New +"**.
   - In the menu that appears, click **"PostgreSQL"**.

3. **Fill in the form**
   - **Name:** Type something you'll recognise, e.g. `boven-db`. (Only you see this; it's just a label.)
   - **Database:** Leave as the default (e.g. the same as the name).
   - **User:** Leave as default.
   - **Region:** Pick one close to you (e.g. **Oregon (US West)** or **Frankfurt (EU Central)**). Your web app should eventually use the same region.
   - **Plan:** Choose **Free** if you're just testing.

4. **Create the database**
   - Click the **"Create Database"** (or **"Create PostgreSQL"**) button at the bottom.
   - Wait until the status says **"Available"** (may take 1–2 minutes).

5. **Copy the Internal Database URL**
   - On the database's page you'll see a section like **"Connections"** or **"Connection string"**.
   - There are usually two URLs: **External** and **Internal**.
   - Click **"Internal"** (or the tab that says Internal).
   - You'll see a long string that looks like:
     `postgres://boven_xxxx:abcdef123456@dpg-xxxxx-a.oregon-postgres.render.com/boven_xxxx`
   - Click the **copy** icon (or select the whole string and copy it).
   - **Paste it into a Notes app or a text file and keep it safe.** You'll paste it again in Step 4 as `DATABASE_URL` and (if you want) `DB_URL`.

You're done with the database. Leave this tab open or remember you can always open this database from the Render dashboard to see the Internal URL again.

---

### Step 3: Create a Web Service (your actual website)

**What this is:** The "Web Service" is the thing that runs your Laravel app and gives you a URL like `https://something.onrender.com`.

1. **Go back to the Render dashboard**
   - Click **"Render"** or the dashboard logo so you're on the main dashboard.

2. **Start creating a Web Service**
   - Click the green **"New +"** button again.
   - This time click **"Web Service"**.

3. **Connect your code (first time only)**
   - If Render says "Connect a repository", you need to connect GitHub (or GitLab):
     - Click **"Connect GitHub"** (or GitLab).
     - Authorise Render when the browser asks.
     - You might see a list of repos; choose **"All repositories"** or select the one that has The Boven Foundation (e.g. `The_Boven_Foundation`).
   - After that, you'll see a list of your repositories.
   - **Click the name of your repo** (e.g. `The_Boven_Foundation`) so it's selected (usually a checkmark or "Connect" next to it).
   - Click **"Connect"** or **"Next"** to go to the settings screen.

4. **Set the name of the service**
   - **Name:** Type something like `boven-foundation` or `the-boven-foundation`. This will be in your URL: `https://boven-foundation.onrender.com`.

5. **Set the Root Directory (very important)**
   - Scroll to a field called **"Root Directory"**.
   - Click in the box and type exactly: **`laravel-app`**
   - (No slash at the start or end.) This tells Render: "All the code for this app is inside the `laravel-app` folder."

6. **Set the Runtime**
   - Find **"Runtime"** or **"Environment"**.
   - Choose **"Docker"** (not "PHP" or "Node"). Your app is set up to run via Docker.

7. **Build and Start commands**
   - Find **"Build Command"** and **"Start Command"**.
   - **Leave both completely empty.** Do not type anything there. The Dockerfile already defines how to build and start.

8. **Create the Web Service**
   - Scroll down and click **"Create Web Service"** (or **"Advanced"** if you want to set env vars first—you can also do that right after).
   - Render will start a first deploy; it might fail until you add environment variables. That's normal. You'll add them in Step 4.

---

### Step 4: Add environment variables

**What this is:** Your app needs secrets and settings (database URL, app key, etc.). You add them as "environment variables" in Render.

1. **Open your Web Service**
   - From the dashboard, click the name of the Web Service you just created (e.g. `boven-foundation`).

2. **Open the Environment tab**
   - At the top you'll see tabs: **Logs**, **Environment**, **Settings**, etc.
   - Click **"Environment"**.

3. **Get your APP_KEY (do this on your computer)**
   - On your computer, open a terminal.
   - Go into your project: `cd path/to/The_Boven_Foundation/laravel-app`
   - Run: `php artisan key:generate --show`
   - Copy the long string it prints (e.g. `base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx=`). That's your `APP_KEY`.

4. **Add each variable one by one**
   - In Render, click **"Add Environment Variable"** (or **"Add Variable"**).
   - Add these **Key** / **Value** pairs (one at a time):

   | Key             | Value (what to type) |
   |-----------------|----------------------|
   | `APP_KEY`       | Paste the key from step 3 above. |
   | `APP_ENV`       | `production` |
   | `APP_DEBUG`     | `false` |
   | `APP_URL`       | `https://YOUR-SERVICE-NAME.onrender.com` — replace YOUR-SERVICE-NAME with the name you gave in Step 3 (e.g. `https://boven-foundation.onrender.com`). |
   | `DB_CONNECTION` | `pgsql` |
   | `DATABASE_URL`  | Paste the **Internal Database URL** you copied in Step 2 (the long `postgres://...` string). |
   | `DB_URL`        | Paste the same Internal Database URL again. (Or leave this out; the app can use `DATABASE_URL`.) |

   - Optional but good for production:
   - **Key:** `ASSET_URL` → **Value:** Same as `APP_URL`, e.g. `https://boven-foundation.onrender.com`

5. **Save**
   - After adding each variable, click **"Save"** or **"Add"**. Render may redeploy automatically after you save env vars.

---

### Step 5: Link PostgreSQL to the Web Service (optional)

**What this is:** If you "link" the database to the Web Service, Render can automatically fill in `DATABASE_URL` for you. You can skip this and use the manual `DATABASE_URL` from Step 4.

1. **Still in your Web Service** → **Environment** tab.
2. Look for **"Link Resource"**, **"Add Resource"**, or **"Environment Groups"**.
3. If you see **"Link Resource"**: click it, choose your PostgreSQL database (e.g. `boven-db`), then confirm. Render will add `DATABASE_URL` for you; you can then remove the manual `DATABASE_URL` you added in Step 4 if you want to avoid duplication.
4. You still must have **`DB_CONNECTION`** = `pgsql` and all the other variables (e.g. `APP_KEY`, `APP_URL`) from Step 4.

---

### Step 6: Deploy and open your site

1. **Trigger or wait for deploy**
   - If you just added env vars, Render often starts a new deploy automatically.
   - If not: open the **"Manual Deploy"** menu (top right) and click **"Deploy latest commit"**.

2. **Watch the build**
   - Click the **"Logs"** tab. You'll see logs for "Build" and "Deploy".
   - The first deploy can take **5–10 minutes** (installing PHP, Composer, Node, npm, building Vue).
   - Wait until the log says something like **"Your service is live at https://…"** or the status at the top turns to **"Live"** (green).

3. **Open your site**
   - At the top of the Web Service page, Render shows the URL, e.g. `https://boven-foundation.onrender.com`.
   - Click it or copy it into your browser. You should see your Boven Foundation website.

4. **If you see an error (500, blank page, "Application error")**
   - Go to **Logs** and read the last lines. Often it's a missing `APP_KEY` or wrong `APP_URL` / `DATABASE_URL`. Fix the env var and save; Render will redeploy.

---

### Step 7: After the first deploy

1. **Seed the database (Team & Projects)**
   - The "Our Leadership Team" and "Our Projects" sections load from the database. The container **runs the seeder automatically** on every start (migrate + `db:seed --force`), so team and projects will appear after the first deploy. No Shell needed (handy on the free tier where Shell is not available).

2. **Queues (only if you use them)**
   - If your app sends email or uses queues, you'd normally add a **Background Worker** that runs `php artisan queue:work`. For a simple first deploy you can skip this; contact forms might use "sync" or "log" for mail until you set that up.

3. **Bookmark your URL**
   - Save `https://your-service-name.onrender.com` so you can come back. Share it with others when you're ready.

---

## Summary checklist

- [ ] Repo pushed; Root Directory = `laravel-app`
- [ ] PostgreSQL created; Internal URL copied
- [ ] Web Service created, Runtime = Docker, no build/start command
- [ ] Env vars set: `APP_KEY`, `APP_URL`, `DB_CONNECTION`, `DATABASE_URL` (and optionally `DB_URL`, `ASSET_URL`)
- [ ] Deploy and test the site and admin/donations

---

## Troubleshooting

- **Build fails on Composer/npm:** Ensure **Root Directory** is `laravel-app` so the Dockerfile and `composer.json`/`package.json` are used.
- **500 or blank page:** Check **Logs** in Render. Often missing `APP_KEY` or wrong `APP_URL`/`DATABASE_URL`.
- **Assets 404:** Set `ASSET_URL` to your full `https://...onrender.com` URL so Laravel/Vite serve assets over HTTPS.
- **Database connection error:** Confirm `DB_CONNECTION=pgsql` and `DATABASE_URL` (or `DB_URL`) is the **Internal** URL, and the Web Service is in the same Render account/region as the DB.
- **Team or Projects section empty:** The start script runs `db:seed --force` after migrate. If sections are still empty, trigger a new deploy (Manual Deploy → Deploy latest commit) so the container restarts and seed runs again. On the free tier, Shell is not available; seeding is done automatically in the container.
