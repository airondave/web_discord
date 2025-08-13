# Topup Game System - Random Community

## Overview
Sistem topup game yang lengkap untuk Random Community, memungkinkan user untuk membeli topup untuk game Valorant dan Genshin Impact menggunakan pembayaran QRIS.

## Fitur Utama

### 🎮 Games Supported
- **Valorant** - Topup VP (Valorant Points)
- **Genshin Impact** - Topup Primogems

### 💳 Payment Methods
- QRIS (GoPay, OVO, DANA, dll)
- Bank Transfer (untuk pengembangan masa depan)

### 🔄 Workflow System
1. User memilih game dan package
2. User mengisi informasi player
3. User melakukan pembayaran via QRIS
4. User konfirmasi pembayaran
5. Admin verifikasi manual
6. Email konfirmasi dikirim ke user
7. Topup diproses dalam 24 jam

## Database Structure

### Tables

#### 1. `games`
- `id` - Primary Key
- `name` - Nama game
- `game_code` - Kode internal (VALORANT, GENSHIN)
- `publisher` - Publisher game
- `created_at` - Timestamp

#### 2. `topup_packages`
- `id` - Primary Key
- `game_id` - Foreign key ke games
- `name` - Nama package
- `amount` - Jumlah dalam game
- `price` - Harga dalam Rupiah
- `created_at` - Timestamp

#### 3. `payment_methods`
- `id` - Primary Key
- `name` - Nama metode pembayaran
- `type` - Jenis (ewallet, bank, credit)
- `created_at` - Timestamp

#### 4. `transactions`
- `id` - Primary Key
- `user_id` - User ID (nullable untuk guest)
- `buyer_name` - Nama pembeli
- `buyer_email` - Email pembeli
- `game_id` - Foreign key ke games
- `package_id` - Foreign key ke topup_packages
- `payment_method_id` - Foreign key ke payment_methods
- `player_id` - ID player di game
- `player_server` - Server player (optional)
- `price` - Harga yang dibayar
- `status` - Status transaksi (pending, paid, failed, delivered)
- `payment_reference` - Referensi pembayaran
- `created_at`, `updated_at` - Timestamps

## File Structure

### Controllers
- `TopupController.php` - Handle user topup flow
- `AdminTopupController.php` - Handle admin management

### Models
- `Game.php` - Game model
- `TopupPackage.php` - Package model
- `PaymentMethod.php` - Payment method model
- `Transaction.php` - Transaction model

### Views
- `topup/index.blade.php` - Halaman utama topup
- `topup/payment.blade.php` - Halaman pembayaran
- `topup/success.blade.php` - Halaman sukses
- `admin/topup/index.blade.php` - Admin dashboard

### Mail Templates
- `emails/topup_confirmation.blade.php` - Email konfirmasi
- `emails/topup_rejection.blade.php` - Email penolakan

## Installation & Setup

### 1. Database Migration
```bash
php artisan migrate
```

### 2. Seed Data
```bash
php artisan db:seed --class=TopupSeeder
```

### 3. Configure Mail Settings
Pastikan konfigurasi SMTP sudah benar di `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email
MAIL_FROM_NAME="Random Community"
```

### 4. Routes
Sistem akan otomatis menambahkan routes berikut:
- `/topup` - Halaman utama topup
- `/topup/payment/{id}` - Halaman pembayaran
- `/admin/topup` - Admin dashboard

## Usage

### For Users
1. Buka `/topup`
2. Pilih game (Valorant/Genshin)
3. Pilih package yang diinginkan
4. Isi informasi player
5. Pilih metode pembayaran
6. Scan QR code dan bayar
7. Klik "Aku sudah bayar"
8. Tunggu verifikasi admin

### For Admins
1. Login ke admin panel
2. Buka menu "Topup" di sidebar
3. Lihat transaksi yang pending
4. Verifikasi pembayaran manual
5. Klik "Process" untuk approve atau "Reject" untuk tolak
6. Jika reject, isi alasan penolakan

## Email Notifications

### Confirmation Email
- Dikirim saat admin approve transaksi
- Berisi detail transaksi dan timeline 24 jam

### Rejection Email
- Dikirim saat admin reject transaksi
- Berisi alasan penolakan dan instruksi refund

## Security Features

- CSRF protection pada semua form
- Admin authentication required
- Input validation dan sanitization
- Secure payment reference generation

## Customization

### Adding New Games
1. Tambah record di table `games`
2. Buat packages di table `topup_packages`
3. Update seeder jika diperlukan

### Adding New Payment Methods
1. Tambah record di table `payment_methods`
2. Update UI untuk menampilkan metode baru

### Modifying Packages
1. Edit langsung di database atau buat admin interface
2. Harga dan jumlah bisa diubah sesuai kebutuhan

## Troubleshooting

### Common Issues

#### Email tidak terkirim
- Cek konfigurasi SMTP di `.env`
- Pastikan queue worker berjalan (jika menggunakan queue)

#### QR Code tidak muncul
- Pastikan URL gambar QRIS bisa diakses
- Cek permission file gambar

#### Transaksi tidak tersimpan
- Cek log Laravel di `storage/logs/laravel.log`
- Pastikan semua required fields terisi

### Debug Mode
Untuk development, aktifkan debug mode di `.env`:
```env
APP_DEBUG=true
APP_ENV=local
```

## Support

Untuk bantuan teknis atau pertanyaan, hubungi:
- Email: support@ranconnity.site
- Discord: https://discord.gg/CdpPfKUK4p

## License

Sistem ini dikembangkan khusus untuk Random Community. Tidak untuk distribusi komersial tanpa izin.

---

**Developed with ❤️ for Random Community** 