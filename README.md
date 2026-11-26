# ⚡ Dynamic-Porto — Full-Stack Portfolio & Control System

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.4" />
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-v4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS v4" />
  <img src="https://img.shields.io/badge/Alpine.js-3.17-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white" alt="Alpine.js" />
  <img src="https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker" />
  <img src="https://img.shields.io/badge/Railway-Production-0B0D0E?style=for-the-badge&logo=railway&logoColor=white" alt="Railway" />
  <img src="https://img.shields.io/badge/Tests-15%20Passed-success?style=for-the-badge&logo=checkmarx&logoColor=white" alt="Tests Passed" />
</p>

<p align="center">
  <strong>Dynamic-Porto</strong> adalah platform portofolio interaktif dinamis dan sistem kontrol admin berbasis monolitik modern yang dirancang khusus untuk memamerkan proyek, spesialisasi teknologi, dan aktivitas rekayasa perangkat lunak milik <strong>Nazwar Makarim Mahardhika</strong> (Siswa XI RPL 2 SMKN 1 Garut).
</p>

<p align="center">
  🌐 <strong>Production Live Demo:</strong> <a href="https://dynamic-porto-production.up.railway.app/">https://dynamic-porto-production.up.railway.app/</a><br>
  📦 <strong>GitHub Repository:</strong> <a href="https://github.com/Nazwarrrr/Dynamic-Porto">https://github.com/Nazwarrrr/Dynamic-Porto</a>
</p>

---

## 🎯 Fitur Unggulan

### 1. 🧱 Desain Token & Antarmuka Bersih
* Sistem warna berbasis CSS custom properties (`--bg`, `--surface`, `--line`, `--ink`, `--accent`) dengan kontras tinggi (WCAG AA) dan dukungan mode gelap/terang otomatis mengikuti preferensi sistem.
* Tata letak responsif untuk menampilkan proyek, keahlian, pengalaman, dan kontak tanpa gangguan visual berlebih.

### 3. ⚡ Client-Side Instant Category Filtering
* Filter kategori proyek dinamis tanpa reload halaman (*no page reload*) berbasis **Alpine.js** dan DOM *data-attributes*.
* Transisi visual instan (*scale & fade*) dengan dukungan *empty state alert*.

### 4. 📖 Dedicated Case Study Pages
* Halaman rincian studi kasus mendalam (`/projects/{id}`) untuk setiap proyek: breadcrumbs, preview media, tantangan arsitektural, solusi, *tech stack pills*, serta tombol eksternal ke repositori kode dan demo aplikasi.

### 5. 🔒 Protected Admin Panel & Full CRUD
* Rute panel admin terisolasi (`/admin/projects`) dilindungi oleh **Laravel Authentication Middleware (`auth`)**.
* Operasi **CRUD Lengkap**:
  * Manajemen proyek (Tambah, Edit, Hapus, dan Listing).
  * Manajemen kategori dengan proteksi integritas data (*foreign key safety check*).
  * Inbox pesan masuk dari formulir kontak.
* **Manajemen File Storage Aman**: Upload gambar otomatis ke `storage/app/public` dan penghapusan otomatis gambar lama dari server saat data diupdate atau dihapus.

### 6. 🌐 Konsumsi & Penyediaan REST API
* **Konsumsi GitHub API:** Mengintegrasikan REST API GitHub untuk menampilkan profil, bio, dan 4 repositori publik teranyar secara real-time dengan layer caching server-side 30 menit (`Cache::put`).
* **Penyediaan Public JSON Endpoint:** Menyediakan endpoint publik `GET /api/projects` untuk konsumsi pihak ketiga berformat JSON standar.
* **Proteksi Rate Limiting:** Form kontak diproteksi pembatasan kuota `throttle:5,1` (maksimal 5 request per menit per alamat IP) untuk mencegah spam bot.

---

## 🏗️ Arsitektur & Teknologi

| Layer | Teknologi & Tools | Keterangan |
| :--- | :--- | :--- |
| **Backend Core** | PHP 8.4 · Laravel 12 | Monolith MVC, Eloquent ORM, Dependency Injection, Validation |
| **Frontend UI** | Tailwind CSS v4 · Alpine.js v3.17 | Modern `@theme` CSS Variables, Vite 8, Lucide Icons |
| **Database** | MySQL (Cloud Instance) | Relasi 1-to-N (`categories` ➜ `projects`), cascading deletes |
| **DevOps & Cloud** | Docker · Railway PaaS | Multi-stage build (`node:22-alpine` & `php:8.4-cli`), SSL Enforced |
| **Testing** | PHPUnit 12 | 15 Feature & Unit test case, 63 assertions passing |

---

## 🗄️ Skema Database Relasional

```
  +------------------+         1 : N         +-------------------+
  |    categories    |-----------------------<     projects      |
  +------------------+                       +-------------------+
  | id (PK)          |                       | id (PK)           |
  | name             |                       | category_id (FK)  |
  | slug (Unique)    |                       | title             |
  | created_at       |                       | description       |
  | updated_at       |                       | tech_stack        |
  +------------------+                       | demo_url          |
                                             | github_url        |
  +------------------+                       | image             |
  |     messages     |                       | created_at        |
  +------------------+                       | updated_at        |
  | id (PK)          |                       +-------------------+
  | sender_name      |
  | sender_email     |                       +-------------------+
  | message          |                       |       users       |
  | created_at       |                       +-------------------+
  | updated_at       |                       | id, name, email.. |
  +------------------+                       +-------------------+
```

---

## 🚀 Panduan Menjalankan di Lokal (Local Development)

### 1. Prasyarat
* PHP >= 8.3 / 8.4
* Composer >= 2.x
* Node.js >= 20.x & npm
* MySQL Database

### 2. Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/Nazwarrrr/Dynamic-Porto.git
cd Dynamic-Porto

# 2. Install dependensi backend & frontend
composer install
npm install

# 3. Konfigurasi Environment File
cp .env.example .env
php artisan key:generate

# 4. Atur koneksi database di file .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dynamic_porto
DB_USERNAME=root
DB_PASSWORD=

# 5. Jalankan migrasi dan seeder database
php artisan migrate:fresh --seed

# 6. Buat symbolic link storage
php artisan storage:link

# 7. Build aset frontend & jalankan server
npm run dev
php artisan serve
```

Aplikasi dapat diakses melalui browser di: `http://localhost:8000`

### 🔑 Akun Admin Panel
Atur `ADMIN_EMAIL` dan `ADMIN_PASSWORD` di file `.env` sebelum menjalankan `php artisan db:seed`. Pada deployment Docker/Railway, atur keduanya sebagai environment variables/secrets di platform; container akan menyinkronkan satu akun admin setelah migrasi. Jika hanya satu variabel yang diatur, proses start akan gagal; jika keduanya tidak diatur, kredensial tidak disinkronkan. Jangan commit nilai `ADMIN_PASSWORD`; gunakan password kuat dan unik.

Login tersedia melalui `http://localhost:8000/login` dengan proteksi rate limiting (maksimal 5 percobaan per menit).

---

## 🧪 Pengujian Otomatis (Automated Testing)

Proyek ini dilengkapi rangkaian pengujian otomatis (*Feature Tests*) untuk memastikan keandalan alur bisnis, validasi input, fungsionalitas seeder, dan integrasi API:

```bash
php artisan test
```

**Hasil Pengujian:**
```text
   PASS  Tests\Unit\ExampleTest
   PASS  Tests\Feature\ExampleTest
   PASS  Tests\Feature\PortfolioPageTest
  ✓ homepage renders navigation targets and github activity
  ✓ homepage renders project fallback and hides empty categories
  ✓ homepage filters projects by category
  ✓ homepage does not render placeholder project links
  ✓ project card shows live and github actions when links exist
  ✓ contact form stores a valid message
  ✓ contact form rejects an invalid email without storing a message
  ✓ homepage still renders when github is unavailable
  ✓ project creation rejects non http urls
  ✓ database seeder can run more than once
  ✓ project detail page renders successfully
  ✓ admin can create and delete category
  ✓ admin cannot delete category with projects

  Tests:    15 passed (63 assertions)
  Duration: 1.02s
```

---

## 🐳 Konfigurasi Deployment Docker & Railway

Aplikasi dipaketkan ke dalam image container menggunakan strategi **Multi-Stage Build** pada [Dockerfile](file:///c:/laragon/www/Dynamic-portofolio/Dockerfile):

```dockerfile
# Stage 1: Build Frontend Assets
FROM node:22-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY resources ./resources
COPY public ./public
COPY vite.config.js ./
RUN npm run build && test -f public/build/manifest.json

# Stage 2: Production PHP Runtime
FROM php:8.4-cli
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY . .
COPY --from=frontend /app/public/build ./public/build
RUN composer install --no-dev --optimize-autoloader \
    && php artisan storage:link
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
```

Enforce skema HTTPS diterapkan secara otomatis pada environment production di `app/Providers/AppServiceProvider.php` demi standar keamanan web modern.

---

## 👤 Pengembang

**Nazwar Makarim Mahardhika**
* 🏫 Siswa XI RPL 2 — SMKN 1 Garut (Rekayasa Perangkat Lunak / PPLG)
* 💼 Minat & Fokus: Full-Stack Web Development, IoT & Embedded Robotics
* 🌐 GitHub: [@Nazwarrrr](https://github.com/Nazwarrrr)
* ✉️ Email: [nazwarmakarim818@gmail.com](mailto:nazwarmakarim818@gmail.com)

---

## 📄 Lisensi

Proyek ini dirilis di bawah lisensi terbuka [MIT License](LICENSE).
