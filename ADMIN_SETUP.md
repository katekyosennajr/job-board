# Admin Account Setup Guide

## Cara Login/Daftar sebagai Admin

### Option 1: Daftar Langsung via UI (Tidak Disarankan - untuk testing saja)
Karena admin role tidak ditampilkan di form registrasi (hanya Candidate dan Company), Anda perlu setup admin manual.

### Option 2: Setup Admin via Database (Recommended)

#### Langkah 1: Daftar sebagai Candidate atau Company dulu
1. Buka http://localhost:8000/register
2. Pilih role "Pencari Kerja" atau "Perusahaan"
3. Lengkapi form (nama, email, password)
4. Klik "Daftar"

#### Langkah 2: Update Role di Database
Setelah registrasi, update user role dari database:

**Via Artisan Tinker:**
```bash
php artisan tinker
```

Kemudian jalankan command berikut:
```php
# Cari user dengan email Anda
$user = App\Models\User::where('email', 'your-email@example.com')->first();

# Update role menjadi admin
$user->update(['role' => 'admin']);

# Verify
$user->role; // Should return 'admin'
```

**Atau via Artisan Command (jika ada custom command):**
```bash
php artisan tinker
App\Models\User::where('email', 'admin@example.com')->update(['role' => 'admin']);
```

#### Langkah 3: Login sebagai Admin
1. Buka http://localhost:8000/login
2. Pilih role "Perusahaan" (placeholder, akan diganti setelah validasi backend)
3. Masukkan email dan password Anda
4. Setelah login berhasil, Anda akan diarahkan ke Admin Dashboard

### Testing Admin Features
Setelah login sebagai admin, Anda bisa:
- Buka `/dashboard` → akan menampilkan Admin Dashboard
- Lihat pending job approvals
- View registered users
- Approve/Reject job listings

## Database Direct Update (Alternative)

Jika Anda punya akses database langsung:

```sql
UPDATE users SET role = 'admin' WHERE email = 'your-email@example.com';
```

## Development Testing

Untuk development environment, bisa langsung update database setelah registrasi.

---

**Note**: Admin role currently tidak ada di registration form. Future update bisa tambah admin registration dengan special code/token verification.
