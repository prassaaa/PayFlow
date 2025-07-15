# PayFlow - HRIS (Human Resource Information System)

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.0-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC34A?style=for-the-badge&logo=alpine.js)](https://alpinejs.dev)

PayFlow adalah sistem informasi sumber daya manusia (HRIS) yang dibangun dengan Laravel 12, menggunakan teknologi modern seperti Tailwind CSS, Alpine.js, dan Laravel Breeze. Sistem ini dirancang untuk membantu perusahaan mengelola data karyawan, absensi, penggajian, dan berbagai aspek HR lainnya secara efisien.

## 🚀 Fitur Utama

### 📊 Dashboard
- **Overview Dashboard**: Ringkasan visual data penting berdasarkan role pengguna
- **Grafik dan Statistik**: Visualisasi data karyawan, absensi, dan tren HR
- **Real-time Updates**: Data yang selalu terkini

### 🏢 Master Data
- **Manajemen Perusahaan**: Kelola data perusahaan dan cabang
- **Departemen**: Organisasi struktur departemen perusahaan
- **Jabatan**: Manajemen posisi dan level jabatan
- **Lokasi Kerja**: Pengaturan lokasi kerja multi-cabang
- **Komponen Gaji**: Konfigurasi komponen gaji (tunjangan, potongan)
- **Hari Libur**: Kalender hari libur nasional dan perusahaan

### 👥 Manajemen Karyawan
- **Database Karyawan**: Profil lengkap karyawan dengan foto
- **Kontrak Kerja**: Manajemen kontrak dan perpanjangan
- **Riwayat Kerja**: Tracking perubahan posisi dan gaji
- **Data Keluarga**: Informasi keluarga untuk keperluan administrasi

### ⏰ Sistem Absensi
- **Data Kehadiran**: Tracking absensi harian dengan lokasi
- **Jadwal Kerja (Shift)**: Manajemen jadwal kerja fleksibel
- **Koreksi Absensi**: Pengajuan dan persetujuan koreksi absensi
- **Overtime**: Penghitungan lembur otomatis

### 🏖️ Manajemen Cuti
- **Pengajuan Cuti**: Sistem pengajuan cuti online
- **Workflow Approval**: Proses persetujuan berlapis
- **Kuota Cuti**: Tracking sisa cuti per karyawan
- **Jenis Cuti**: Berbagai tipe cuti (tahunan, sakit, dll)

### 💰 Sistem Payroll
- **Proses Gaji**: Perhitungan gaji otomatis bulanan
- **Slip Gaji**: Generate slip gaji digital
- **PPh 21**: Perhitungan pajak penghasilan otomatis
- **BPJS**: Integrasi perhitungan BPJS Kesehatan & Ketenagakerjaan
- **Komponen Variabel**: Bonus, insentif, dan potongan

### 🧾 Manajemen Klaim
- **Reimbursement**: Klaim penggantian biaya
- **Medical Claims**: Klaim kesehatan
- **Travel Claims**: Klaim perjalanan dinas
- **Approval System**: Sistem persetujuan klaim

### 📈 Sistem Laporan
- **Laporan Gaji**: Payroll summary dan detail
- **Laporan Absensi**: Rekapitulasi kehadiran
- **Laporan Pajak**: PPh 21 dan pelaporan pajak
- **Laporan BPJS**: Iuran dan klaim BPJS
- **Export**: Excel dan PDF export

### 🔐 Employee Self Service (ESS)
- **Portal Karyawan**: Akses data pribadi
- **Slip Gaji Digital**: Download slip gaji
- **Pengajuan Cuti**: Submit cuti online
- **Klaim Reimburse**: Ajukan klaim penggantian

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 12**: Framework PHP modern dengan fitur terbaru
- **PHP 8.2+**: Dengan fitur-fitur modern PHP
- **MySQL**: Database utama untuk penyimpanan data
- **Spatie Permission**: Role dan permission management
- **Laravel Breeze**: Authentication starter kit

### Frontend
- **Tailwind CSS 4.0**: Utility-first CSS framework
- **Alpine.js 3.x**: Lightweight JavaScript framework
- **Blade Templates**: Laravel templating engine
- **Dark Mode**: Mendukung tema gelap

### Packages & Libraries
- **Spatie Media Library**: File dan media management
- **Maatwebsite Excel**: Export/import Excel
- **DomPDF**: Generate PDF documents
- **Spatie Activity Log**: User activity tracking

## 📋 Requirement System

### Server Requirements
- **PHP**: 8.2 atau lebih tinggi
- **Web Server**: Apache/Nginx
- **Database**: MySQL 8.0+ atau MariaDB 10.3+
- **Memory**: Minimal 512MB RAM
- **Storage**: Minimal 1GB free space

### PHP Extensions
```
- BCMath
- Ctype
- cURL
- DOM
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PCRE
- PDO
- Tokenizer
- XML
- GD atau ImageMagick
```

### Node.js Requirements
- **Node.js**: 18.x atau lebih tinggi
- **NPM**: 8.x atau lebih tinggi

## 🔧 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/yourusername/payflow.git
cd payflow
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=payflow
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Database Migration & Seeding
```bash
# Run migrations
php artisan migrate

# Seed database with initial data
php artisan db:seed
```

### 6. Storage Setup
```bash
# Create storage link
php artisan storage:link

# Set permissions (Linux/Mac)
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 7. Build Assets
```bash
# Build for development
npm run dev

# Build for production
npm run build
```

### 8. Start Development Server
```bash
# Laravel development server
php artisan serve

# Vite development server (separate terminal)
npm run dev
```

## 👥 Default User Accounts

Setelah seeding database, tersedia akun default:

| Role | Email | Password | Akses |
|------|-------|----------|-------|
| Super Admin | admin@payflow.com | password | Full Access |
| HR Manager | hr@payflow.com | password | HR Management |
| Finance | finance@payflow.com | password | Payroll & Reports |
| Employee | employee@payflow.com | password | Self Service |

## 🔐 Role & Permission System

### Role Hierarchy
1. **Super Admin** - Akses penuh ke semua fitur
2. **HR Manager** - Manajemen HR dan karyawan
3. **HR Staff** - Operasional HR terbatas
4. **Finance** - Fokus payroll dan laporan keuangan
5. **Employee** - Employee self service

### Permission Categories
- **Dashboard**: `view_dashboard`
- **Master Data**: `view_master_data`, `create_company`, `edit_company`, dll
- **Employee Management**: `view_employees`, `create_employee`, dll
- **Attendance**: `view_attendance`, `manage_schedules`, dll
- **Leave Management**: `view_leaves`, `approve_leave`, dll
- **Payroll**: `view_payroll`, `process_payroll`, dll
- **Claims**: `view_claims`, `approve_claim`, dll
- **Reports**: `view_reports`, `export_reports`, dll
- **Self Service**: `view_own_profile`, `view_own_payslip`, dll
- **System**: `manage_users`, `manage_roles`, dll

## 📁 Struktur Project

```
payflow/
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/              # Eloquent models
│   ├── Providers/           # Service providers
│   └── Services/            # Business logic services
├── database/
│   ├── migrations/          # Database migrations
│   ├── seeders/             # Database seeders
│   └── factories/           # Model factories
├── resources/
│   ├── views/               # Blade templates
│   ├── js/                  # JavaScript files
│   └── css/                 # CSS files
├── routes/
│   ├── web.php              # Web routes
│   └── api.php              # API routes
├── public/                  # Public assets
├── storage/                 # Storage files
└── config/                  # Configuration files
```

## 🎨 Customization

### Tema dan Styling
PayFlow menggunakan Tailwind CSS dengan dukungan dark mode. Untuk kustomisasi:

```bash
# Edit tailwind.config.js untuk custom colors
# Edit resources/css/app.css untuk custom styles
# Rebuild assets
npm run build
```

### Menu Navigation
Menu sistem dikonfigurasi di `app/Providers/MenuServiceProvider.php` dengan:
- Role-based menu visibility
- Dynamic submenu generation
- Active state management
- Icon support

### Database Schema
Struktur database dapat disesuaikan dengan kebutuhan:
- Edit migrations di `database/migrations/`
- Update models di `app/Models/`
- Run migration: `php artisan migrate`

## 🔄 Update & Maintenance

### Update Dependencies
```bash
# Update PHP dependencies
composer update

# Update Node.js dependencies
npm update

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Backup Database
```bash
# Backup database
mysqldump -u username -p payflow > backup.sql

# Restore database
mysql -u username -p payflow < backup.sql
```

## 🐛 Troubleshooting

### Common Issues

1. **Permission Denied**
   ```bash
   sudo chown -R www-data:www-data storage
   sudo chown -R www-data:www-data bootstrap/cache
   ```

2. **Database Connection Error**
   - Check `.env` database configuration
   - Verify MySQL service is running
   - Test connection manually

3. **Assets Not Loading**
   ```bash
   npm run build
   php artisan config:clear
   ```

4. **Storage Link Issue**
   ```bash
   php artisan storage:link
   ```

## 📞 Support

Untuk bantuan dan support:
- 📧 Email: support@payflow.com
- 📱 WhatsApp: +62-xxx-xxx-xxxx
- 🌐 Website: https://payflow.com

## 📄 License

PayFlow adalah software open source yang dilisensikan under [MIT License](LICENSE).

---

**Dibuat dengan ❤️ untuk memudahkan pengelolaan HR di Indonesia**
