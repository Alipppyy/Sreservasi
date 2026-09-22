# 🛠️ SReservasi

### Sistem Reservasi & Manajemen Teknisi Berbasis Web

> **SReservasi** adalah aplikasi web untuk membantu mengelola proses reservasi, pengguna, dan teknisi secara lebih terstruktur, sederhana, dan efisien.

---

## ✨ Tentang Project

**SReservasi** dibuat sebagai sistem manajemen reservasi berbasis web yang memanfaatkan framework **Laravel**.

Aplikasi ini dirancang untuk membantu administrator dalam mengelola data dan aktivitas reservasi serta memudahkan pengelolaan pengguna berdasarkan hak akses.

Project ini cocok digunakan sebagai **aplikasi administrasi, project sekolah, portfolio web development, maupun dasar pengembangan sistem reservasi yang lebih kompleks.**

---

## 🚀 Fitur

* 🔐 **Authentication**

  * Login pengguna
  * Logout
  * Manajemen akses pengguna

* 👤 **Role Management**

  * Admin
  * Teknisi

* 📋 **Manajemen Data**

  * Pengelolaan data sistem
  * Pengelolaan pengguna
  * Pengelolaan teknisi

* 📅 **Sistem Reservasi**

  * Pengelolaan proses reservasi
  * Pencatatan data reservasi
  * Monitoring data

* 🗄️ **Database Management**

  * MySQL
  * Migration & seeding Laravel
  * Database SQL tersedia dalam repository

* ⚡ **Modern Development**

  * Laravel
  * Vite
  * Axios
  * Laravel Sanctum

---

## 🧰 Tech Stack

| Teknologi                  | Penggunaan     |
| -------------------------- | -------------- |
| 🐘 PHP 8.1+                | Backend        |
| 🔥 Laravel 10              | Web Framework  |
| 🗄️ MySQL                  | Database       |
| ⚡ Vite                     | Asset Bundling |
| 📡 Axios                   | HTTP Client    |
| 🔑 Laravel Sanctum         | Authentication |
| 🎨 HTML / CSS / JavaScript | Frontend       |

Project menggunakan Laravel Framework `^10.10` dan PHP `^8.1`.

---

## 📁 Struktur Project

```text
Sreservasi/
│
├── app/                # Logic aplikasi
├── bootstrap/          # Bootstrap Laravel
├── config/             # Konfigurasi aplikasi
├── database/           # Migration, factory & seeder
├── public/             # Asset publik
├── resources/          # View & asset frontend
├── routes/             # Routing aplikasi
├── storage/            # File & cache aplikasi
├── tests/              # Automated tests
│
├── .env.example        # Contoh konfigurasi environment
├── artisan              # Laravel CLI
├── composer.json        # PHP dependencies
├── package.json         # Frontend dependencies
├── vite.config.js       # Konfigurasi Vite
├── db.sql               # Database SQL
└── README.md            # Dokumentasi project
```

Struktur repository saat ini memang menggunakan pola Laravel standar dengan folder `app`, `database`, `resources`, `routes`, `storage`, dan `tests`.

---

## ⚙️ Installation

### 1. Clone Repository

```bash
git clone https://github.com/Alipppyy/Sreservasi.git
```

Masuk ke folder project:

```bash
cd Sreservasi
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
```

### 4. Setup Environment

Copy file `.env.example` menjadi `.env`.

```bash
cp .env.example .env
```

Untuk Windows:

```bash
copy .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Buat database:

```text
sistem_reservasi
```

Kemudian sesuaikan konfigurasi database pada `.env`.

Contoh:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_reservasi
DB_USERNAME=root
DB_PASSWORD=
```

Repository juga menyediakan file `db.sql` yang membuat database `sistem_reservasi`.

### 7. Jalankan Database

Jika menggunakan migration:

```bash
php artisan migrate
```

Atau import:

```text
db.sql
```

ke MySQL / phpMyAdmin.

### 8. Jalankan Development Server

Terminal pertama:

```bash
php artisan serve
```

Terminal kedua:

```bash
npm run dev
```

Kemudian buka:

```text
http://127.0.0.1:8000
```

---

## 🔐 Role Pengguna

Sistem memiliki beberapa role pengguna:

### 👑 Admin

Admin memiliki akses untuk mengelola sistem dan data pengguna.

### 🔧 Teknisi

Teknisi digunakan sebagai pengguna yang menangani aktivitas yang berkaitan dengan pekerjaan teknis.

Role tersebut tersimpan pada tabel `users` dengan pilihan `admin` dan `teknisi`.

---

## 🗃️ Database

Database utama:

```text
sistem_reservasi
```

Struktur pengguna menggunakan tabel:

```text
users
```

dengan beberapa informasi seperti:

* ID
* Nama
* Email
* Password
* Role
* Timestamp

Role yang tersedia:

```text
admin
teknisi
```

---

## 🖥️ Development

Untuk menjalankan project dalam mode development:

```bash
php artisan serve
```

dan:

```bash
npm run dev
```

Untuk melakukan build asset production:

```bash
npm run build
```

Script frontend tersebut tersedia pada `package.json` project.

---

## 🔒 Security

Beberapa hal yang perlu diperhatikan ketika menjalankan project:

* Jangan upload file `.env` ke repository.
* Gunakan password database yang aman.
* Jangan membagikan `APP_KEY`.
* Gunakan akun dengan hak akses sesuai kebutuhan.
* Ganti credential default sebelum digunakan pada production.

---

## 📌 Roadmap

Pengembangan selanjutnya dapat mencakup:

* [ ] Dashboard statistik
* [ ] Notifikasi reservasi
* [ ] Filter & pencarian data
* [ ] Export laporan PDF
* [ ] Export laporan Excel
* [ ] Riwayat reservasi
* [ ] Manajemen jadwal teknisi
* [ ] Responsive mobile interface
* [ ] REST API
* [ ] Role & permission yang lebih fleksibel

---

Struktur folder yang disarankan:

```text
screenshots/
├── login.png
├── dashboard.png
└── reservasi.png
```

---

## 🤝 Contributing

Pull request dan improvement sangat terbuka.

1. Fork repository
2. Buat branch baru

```bash
git checkout -b feature/nama-fitur
```

3. Commit perubahan

```bash
git commit -m "feat: tambah fitur baru"
```

4. Push branch

```bash
git push origin feature/nama-fitur
```

5. Buat Pull Request

---

## 📄 License

Project ini menggunakan lisensi **MIT**.

---

## 👨‍💻 Developer

**Alipppyy**

---

<p align="center">
  Made with ❤️ using Laravel
</p>

<p align="center">
  ⭐ Jika project ini membantu, jangan lupa beri star!
</p>
