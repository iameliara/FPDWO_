# Cara Pasang Website

Tools yang dibutuhkan:

- Apache + PHP (disediakan oleh XAMPP)
- MySQL/MariaDB (disediakan oleh XAMPP)
- phpMyAdmin (disediakan oleh XAMPP)
- Git (harap menginstall sendiri)

## Step 1 - Clone Repository

1. Pelajari Git dan command line terlebih dahulu
2. Masuk ke dalam folder **htdocs** pada XAMPP
3. Clone repository ini dengan Git sehingga terdapat folder **pemweb-cuti** di dalam **htdocs** anda

## Step 2 - Pasang Database

1. Pastikan service **MySQL** atau **MariaDB** berjalan pada XAMPP
2. Buka **phpMyAdmin** melalui XAMPP control panel (mengklik tombol **Admin** pada service MySQL/MariaDB)
3. Buat database baru: **pemweb_cuti**
4. Lanjutkan ke **step 3** (bawah) untuk melakukan migration

## Step 3 - Pasang Website

1. Buka terminal atau command prompt
2. Jalankan perintah `composer update` (harus ada koneksi internet terlebih dahulu)
3. Buat file **.env** dari template **.env.example** dan ubah kredensial database pada file **.env** sesuai dengan keadaan server masing-masing
4. Jalankan perintah `php artisan key:generate --ansi`
5. Jalankan perintah `php artisan migrate:fresh --seed`
6. Jalankan perintah `php artisan serve` dan kunjungi URL nya

# Coding Guidelines

Ikuti panduan berikut supaya code yang dihasilkan dapat dimaintain dengan mudah dan bisa selaras satu sama lain. **Jangan memodifikasi code di luar controller/view yang menjadi jatah/bagian masing-masing**. Jika ingin request library atau function di luar controller untuk membantu kalian memudahkan pengerjaan, bisa beritahu miko supaya dibuatkan function/library tersebut.

## Controller

Buatlah method pada controller yang **wajib** diperlukan pada **routes/web.php** sesuai dengan bagiannya masing-masing. Semua controller sudah disediakan, tinggal menambah method-methodnya sesuai pada argumen pada file routes.

## Model

Model sudah terdefinisi dan dihandle oleh miko, termasuk relationship-relationshipnya. Tinggal pakai saja. Diharapkan untuk menggunakan fitur **relationship** untuk mendapatkan data dari tabel lain (gunakan eager loading dengan **with** apabila perlu untuk meningkatkan performa). Apabila tidak bisa menggunakan relationship, maka bisa menggunakan **join** pada query builder. Tetapi diutamakan untuk menggunakan **relationship**.

Untuk keseluruhan query basic (CRUD) juga **wajib** menggunakan model ORM, **jangan** query builder.

## Link dan Redirection

Untuk melakukan redirection, **selalu** gunakan **named route** jangan **URL**. Sebagai contoh:

```php
// BENAR:
return redirect()->route('some.route');
return redirect()->route('some.route', ['param' => 'value']);

// SALAH:
return redirect('/some/route');
```

Begitu juga apabila menggunakan link:

```html
<!-- BENAR: -->
<a href="{{ route('some.route') }}"></a>

<!-- SALAH: -->
<a href="{{ url('/some/route') }}">Link</a>
<a href="/some/route">Link</a>
```

Referensi mengenai named route terdapat pada file **routes/web.php**. Lapor ke miko apabila terdapat route yang belum terdefinisi sebagai named route.

## Status Success & Error

Berikan flash data pada session saat akan redirect ke halaman tertentu. Untuk status bahwa sebuah tindakan berhasil dilakukan, flash dengan nilai **status**. Untuk error bahwa tindakan gagal dilakukan, flash dengan bantuan **withErrors** dan key **error**. Berikut adalah contohnya:

```php
return redirect()->route('some.route')->with('status', 'Berhasil menyimpan data');
```

```php
return redirect()->route('some.route')->withErrors(['error' => 'Gagal menyimpan data']);
```

## Authentication

> NOTE : Beri code "use Illuminate\Support\Facades\Auth;" terlebih dahulu supaya code berikut dapat dijalankan

Untuk mendapatkan ID dari **admin** atau **pegawai** yang terlogin, gunakan sintaks berikut (contoh):

```php
// ID admin
$idAdmin = Auth::guard('admin')->id();

// ID pegawai
$idPegawai = Auth::guard('pegawai')->id();
```

Untuk mendapatkan object/data dari **admin** atau **pegawai** yang terlogin, gunakan sintaks berikut (contoh):

```php
// Data admin (dalam bentuk model ORM)
$admin = Auth::guard('admin')->user();
echo 'Hello, '.$admin->nama;

// Data pegawai (dalam bentuk model ORM)
$pegawai = Auth::guard('pegawai')->user();
echo 'Hello, '.$pegawai->nama;
```

## Bugs & Problems

Jika terdapat suatu bug atau kendala (misal bug pada model, atau bug pada middleware, atau method yang kalian bikin gak work, dll), lapor ke miko biar langsung diperbaiki dan diselesaikan supaya tidak mengganggu pekerjaan kalian.

## Development

Proses development selebihnya akan dikoordinasi melalui group WhatsApp.

## Testing

Untuk melakukan testing sebagai **admin**, gunakan kredensial berikut:

- E-mail: **root@localhost.localdomain**
- Password: **root**
- Kemudian masuk ke **/admin/login**

Untuk melakukan testing sebagai **pegawai**, gunakan kredensial berikut:

- Lihat pada file seeder (database/seeders/DatabaseSeeder.php) untuk daftar pegawai selengkapnya
- NIK: **(autogenerate, dapat melihat database)**
- Password: **(bisa melihat pada seeder)**
- Kemudian masuk ke **/pegawai/login**
