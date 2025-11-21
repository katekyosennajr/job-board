# Job Board - AI Agent Instructions

## Project Overview

**Job Board** adalah platform job posting yang memungkinkan candidates mencari pekerjaan, companies merekrut, dan admins mengelola platform. Built dengan Laravel 11 + Vue 3 + Inertia + Tailwind CSS.

**Key Features**:
- Multi-role authentication (Candidate, Company, Admin)
- Job posting & management
- Advanced job search with filters
- Job applications tracking
- Company profiles
- Admin approval workflow

---

## Architecture & Tech Stack

### Frontend
- **Vue 3** (Composition API)
- **Inertia.js** (SSR-ready SPA)
- **Tailwind CSS 3** (utility-first styling)
- **Vite** (build tool)

### Backend
- **Laravel 11** (PHP framework)
- **Eloquent ORM** (database abstraction)
- **Sanctum** (API authentication)

### Database
- **Development**: SQLite (current)
- **Production**: PostgreSQL (see deployment guide below)

### Deployment Ready
- **Docker** (containerization)
- **Render / Railway / Fly.io** (free PostgreSQL hosting)

---

## Project Structure

```
job-board/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── JobController.php          (Job CRUD - company only)
│   │   │   ├── JobApplicationController.php (Applications tracking)
│   │   │   ├── Admin/AdminJobController.php (Job approvals)
│   │   │   └── Candidate/DashboardController.php
│   │   ├── Kernel.php                     (Middleware)
│   │   └── Middleware/                    (company, admin, verified)
│   ├── Models/
│   │   ├── User.php                       (Auth + roles)
│   │   ├── Job.php                        (Job listings)
│   │   ├── JobApplication.php
│   │   ├── CompanyProfile.php
│   │   └── CandidateProfile.php
│   └── Providers/
├── resources/
│   ├── js/
│   │   ├── Pages/
│   │   │   ├── Welcome.vue                (Landing page)
│   │   │   ├── Dashboard.vue              (Role router)
│   │   │   ├── Dashboard/
│   │   │   │   ├── Candidate.vue          (My apps, saved jobs)
│   │   │   │   ├── Company.vue            (Jobs CRUD)
│   │   │   │   └── Admin.vue              (Approvals, users)
│   │   │   └── Jobs/
│   │   │       ├── Index.vue              (Job listings + filters)
│   │   │       └── Show.vue               (Job detail + company)
│   │   ├── Components/
│   │   │   ├── JobCard.vue                (Reusable card)
│   │   │   ├── SearchFilter.vue           (Advanced filters)
│   │   │   └── Navigation.vue             (Navbar)
│   │   ├── Layouts/
│   │   │   ├── AppLayout.vue              (Main layout)
│   │   │   └── AuthLayout.vue             (Auth pages)
│   │   └── app.js                         (Vue entry)
│   └── css/
│       └── app.css                        (Tailwind + custom)
├── routes/
│   ├── web.php                            (Web routes)
│   └── auth.php                           (Auth scaffolding)
├── database/
│   ├── migrations/                        (DB schema)
│   └── seeders/
├── docker-compose.yml                     (Dev + prod variants)
└── Dockerfile
```

---

## Key Patterns & Conventions

### 1. Role-Based Access Control (RBAC)

**User Roles**:
```php
'candidate' → Seeker jobs, apply, manage applications
'company'  → Post jobs, manage listings, view applicants
'admin'    → Approve jobs, manage users, platform oversight
```

**Middleware Implementation**:
```php
// app/Http/Middleware/CompanyMiddleware.php
public function handle($request, $next) {
    if (auth()->user()->role !== 'company') abort(403);
    return $next($request);
}

// Usage in routes/web.php
Route::middleware(['auth', 'company'])->group(function () {
    Route::resource('jobs', JobController::class);
});
```

**Frontend Role Checks**:
```vue
<!-- Only show for company users -->
<button v-if="$page.props.auth.user.role === 'company'">Post Job</button>
```

### 2. Dashboard Routing Pattern

**Single `/dashboard` endpoint, different component per role**:

```php
// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// app/Http/Controllers/Candidate/DashboardController.php
public function index() {
    return Inertia::render('Dashboard', [
        'role' => auth()->user()->role,
        'data' => $this->getRoleData()
    ]);
}
```

**Frontend Router** (`resources/js/Pages/Dashboard.vue`):
```vue
<script setup>
import DashboardCandidate from './Dashboard/Candidate.vue';
import DashboardCompany from './Dashboard/Company.vue';
import DashboardAdmin from './Dashboard/Admin.vue';

const { role } = defineProps(['role']);
const component = {
  candidate: DashboardCandidate,
  company: DashboardCompany,
  admin: DashboardAdmin
}[role];
</script>

<template>
  <component :is="component" />
</template>
```

### 3. Job Status Workflow

```php
// app/Models/Job.php
public function getStatusBadge() {
    return match($this->status) {
        'pending' => 'bg-yellow-100 text-yellow-800',  // Awaiting admin review
        'approved' => 'bg-green-100 text-green-800',   // Published
        'rejected' => 'bg-red-100 text-red-800',       // Not approved
        'closed' => 'bg-gray-100 text-gray-800'        // Archived
    };
}
```

**Status Transitions**:
- Company posts job → `pending` (awaits admin)
- Admin approves → `approved` (visible to candidates)
- Admin rejects → `rejected` (hidden, company can edit & resubmit)

### 4. Vue 3 Composition API Pattern

```vue
<script setup>
import { ref, computed, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const jobs = ref([]);
const sortBy = ref('newest');

const sortedJobs = computed(() => {
  if (sortBy.value === 'newest') return jobs.value;
  if (sortBy.value === 'salary-high') {
    return [...jobs.value].sort((a, b) => b.max_salary - a.max_salary);
  }
  return jobs.value;
});

onMounted(async () => {
  // Fetch jobs
});
</script>

<template>
  <div>
    <select v-model="sortBy" class="...">
      <option value="newest">Newest First</option>
      <option value="salary-high">Highest Salary</option>
    </select>
    <div v-for="job in sortedJobs" :key="job.id">
      <JobCard :job="job" />
    </div>
  </div>
</template>
```

### 5. Tailwind CSS Design Tokens

**Color System** (subtle, professional):
```css
/* Primary: Indigo (recruiting standard) */
--primary: #4F46E5
--primary-light: #EEF2FF
--primary-dark: #3730A3

/* Accent: Emerald (CTAs) */
--accent: #10B981
--accent-light: #ECFDF5
--accent-dark: #047857

/* Neutral: Slate */
--neutral-50: #F8FAFC
--neutral-900: #0F172A

/* Status Colors */
--success: #10B981
--warning: #F59E0B
--error: #EF4444
```

**Spacing**: 4px base unit (4, 8, 12, 16, 24, 32, 48, 64px)

**Typography**:
- H1: 48px, font-bold
- H2: 32px, font-bold
- H3: 24px, font-semibold
- Body: 14-16px, font-regular

---

## Common Development Workflows

### Adding a New Feature

1. **Create Controller** (app/Http/Controllers/YourController.php)
   ```php
   public function store(Request $request) {
       $validated = $request->validate([...]);
       Model::create($validated);
       return redirect()->route('')->with('success', 'Berhasil!');
   }
   ```

2. **Create/Update Vue Component** (resources/js/Pages/YourPage.vue)
   ```vue
   <script setup>
   import { ref } from 'vue';
   import { Head, Link } from '@inertiajs/vue3';
   </script>
   ```

3. **Add Route** (routes/web.php)
   ```php
   Route::resource('items', ItemController::class)->middleware('auth');
   ```

4. **Commit with Indonesian message**
   ```bash
   git add .
   git commit -m "tambah fitur item management"
   git push origin main
   ```

### Database Workflow (SQLite → PostgreSQL)

**For Development** (SQLite - current):
```bash
php artisan migrate
php artisan db:seed
php artisan serve
```

**For Production** (PostgreSQL):
1. Use `docker-compose.yml` (auto handles PostgreSQL)
2. Update `.env`:
   ```
   DB_CONNECTION=pgsql
   DB_HOST=db
   DB_PORT=5432
   DB_DATABASE=job_board
   DB_USERNAME=postgres
   DB_PASSWORD=...
   ```
3. Run: `docker-compose up`

### Testing Flow

```bash
# Unit tests
php artisan test --filter="JobTest"

# Feature tests (browser-like)
php artisan test --filter="JobApplicationTest"

# With coverage
php artisan test --coverage
```

---

## Critical Files & Their Purpose

| File | Purpose | Modify When |
|------|---------|-------------|
| `routes/web.php` | All web routes, role middleware | Adding new pages/features |
| `app/Http/Middleware/CompanyMiddleware.php` | Company-only access | Changing role logic |
| `app/Models/Job.php` | Job model + relationships | Updating job schema |
| `resources/js/Pages/Dashboard.vue` | Dashboard router | Changing dashboard structure |
| `resources/js/Components/JobCard.vue` | Reusable job display | Updating job card UI |
| `tailwind.config.js` | Design tokens | Adding new colors/utilities |
| `.env` | Environment config | Different for dev/prod/Docker |

---

## Deployment & Docker Guide

### Local Development (Current - SQLite)
```bash
npm install
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

### Docker Setup (PostgreSQL Ready)

**Build & Run**:
```bash
docker-compose up -d
docker-compose exec app php artisan migrate
npm run build
```

**Accessing Services**:
- App: `http://localhost:8000`
- PostgreSQL: `localhost:5432` (db service)
- PhpMyAdmin: `http://localhost:8080` (optional)

### Deployment to Render / Railway

1. **Push to GitHub** (already in main)
2. **Create project on Render/Railway**
3. **Set environment variables**:
   - `DB_CONNECTION=pgsql`
   - `DB_HOST=` (provided by Render)
   - `DB_PASSWORD=` (auto-generated)
   - `APP_KEY=` (copy from .env)
4. **Deploy** - auto-detects Laravel + runs migrations

---

## Common Issues & Solutions

### Issue: "SQLSTATE[HY000]: General error"
**Solution**: Fresh migrate on new database
```bash
php artisan migrate:fresh --seed
```

### Issue: CORS errors on API calls
**Solution**: Check `config/cors.php` - add frontend domain

### Issue: Images not loading in production
**Solution**: Run `php artisan storage:link` + check `config/filesystems.php`

### Issue: Vue component not rendering
**Solution**: Check `resources/js/app.js` - confirm component auto-import working

---

## Performance Checklist

- ✅ Jobs cached (n+1 queries prevented with `with('company')`)
- ✅ Pagination used for large datasets
- ✅ Images optimized before upload
- ✅ CSS/JS minified in production (`npm run build`)
- ✅ Database indexed on frequently-queried columns

---

## Coding Standards

- **PHP**: PSR-12 (Laravel convention)
- **Vue**: Script setup syntax, Composition API
- **CSS**: Tailwind utilities (no CSS files for components)
- **Naming**: camelCase for JS, snake_case for PHP/DB
- **Git**: Bahasa Indonesia, short descriptive messages

---

## Key Contacts & Resources

- **Laravel Docs**: https://laravel.com/docs
- **Vue 3 Docs**: https://vuejs.org
- **Inertia Docs**: https://inertiajs.com
- **Tailwind Docs**: https://tailwindcss.com

---

**Last Updated**: November 19, 2025
