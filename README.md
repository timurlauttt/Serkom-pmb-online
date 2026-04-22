# Sistem Informasi Pendaftaran Calon Siswa (TAMSIS) 
## untuk Sertifikasi Kompetensi BNSP Pengembang WEB

Platform digital untuk manajemen pendaftaran calon siswa baru secara online dengan sistem verifikasi data, tracking status, dan pelaporan terintegrasi.

---

## 📋 Daftar Isi
1. [Ringkasan Proyek](#ringkasan-proyek)
2. [Fitur Utama](#fitur-utama)
3. [Alur Sistem Pendaftaran](#alur-sistem-pendaftaran)
4. [Fitur Calon Siswa](#fitur-calon-siswa)
5. [Fitur Administrator](#fitur-administrator)
6. [Model Data & Database](#model-data--database)
7. [Teknologi yang Digunakan](#teknologi-yang-digunakan)
8. [Instalasi](#instalasi)
9. [API Endpoints](#api-endpoints)
10. [Troubleshooting](#troubleshooting)

---

## 🎯 Ringkasan Proyek

TAMSIS adalah sistem informasi manajemen pendaftaran siswa baru yang dibangun dengan Laravel 11 dan PHP modern. Sistem ini memisahkan dua role utama:
- **Calon Siswa (Casisbas):** Mendaftar, melengkapi data pribadi, dan memantau status penerimaan
- **Administrator:** Mengelola data calon siswa, verifikasi, dan memproses pendaftaran formal

---

## ✨ Fitur Utama

### 🎓 Untuk Calon Siswa:
- ✅ **Autentikasi:** Registrasi dan login dengan email
- ✅ **Data Pribadi:** Pengisian data diri lengkap (biodata, alamat, keluarga, agama)
- ✅ **Lokasi Indonesia:** Pemilihan provinsi/kabupaten tempat tinggal dan tempat lahir
- ✅ **Fleksibilitas Tempat Lahir:** Opsi lahir di luar negeri atau Indonesia
- ✅ **Cetak Bukti:** Generate PDF bukti pendaftaran
- ✅ **Tracking Status:** Lihat status penerimaan (menunggu/diterima/ditolak)

### 👨‍💼 Untuk Administrator:
- ✅ **Dashboard Calon Siswa:** Daftar lengkap calon siswa dengan filter dan search
- ✅ **Verifikasi Kelengkapan:** Monitoring progress pengisian data (persentase kelengkapan)
- ✅ **Edit Data:** Modifikasi data calon siswa dengan validasi
- ✅ **Manajemen Pendaftaran:** CRUD untuk pendaftaran formal siswa
- ✅ **Status Management:** Update status pembayaran dan pendaftaran
- ✅ **Download Dokumen:** Download file dokumen yang diupload (ijazah, akta, KK, dll)
- ✅ **Export Data:** Export ke CSV untuk laporan
- ✅ **Perubahan Password Admin:** Update password calon siswa bila diperlukan

---

## 🔄 Alur Sistem Pendaftaran

### **Dua Alur Paralel:**

```
┌─── CALON SISWA (Casisbas) ─────────────────────┐
│                                                 │
├─ Register & Login                              │
├─ Input Data Pribadi Lengkap                    │
├─ Cetak Bukti Pendaftaran                       │
├─ Monitoring Status Penerimaan                  │
└─ (Hasil Keputusan: Diterima/Ditolak)          │
                                                 │
┌─── PENDAFTARAN SISWA (Pendaftaran) ────────────┐
│                                                 │
├─ Admin Input Data Pendaftaran Formal           │
├─ Upload Dokumen (Ijazah, Akta, KK, dll)       │
├─ Verifikasi & Update Status Pembayaran        │
├─ Verifikasi Dokumen Lengkap                   │
├─ Proses Seleksi & Pengumuman Hasil            │
└─ Siswa Lolos Masuk Sistem Sekolah             │
```

---

## 🎓 Fitur Calon Siswa

### **1. Autentikasi (Login & Register)**

**Lokasi:** `PendaftaranLoginController@showLoginForm()` | `showRegisterForm()`

#### Register Calon Siswa:
```php
POST /pmb/register
```

**Validasi Input:**
- `username` (nama lengkap): Required, max 255 karakter
- `email`: Required, unique, format email valid
- `phone`: Required, max 20 karakter
- `password`: Required, min 6 karakter, confirmed

**Proses:**
1. Validasi input dari form registrasi
2. Hash password dengan bcrypt
3. Buat record di tabel `casisbas`
4. Auto login: Set session `casisbas_id`
5. Redirect ke dashboard

**Response:**
```json
{
  "status": "success",
  "message": "Registrasi berhasil! Silakan lengkapi data diri Anda.",
  "redirect": "/pmb/dashboard"
}
```

#### Login Calon Siswa:
```php
POST /pmb/login
```

**Validasi Input:**
- `username` (email): Required, format email valid
- `password`: Required

**Proses:**
1. Cari user di tabel `casisbas` berdasarkan email
2. Verifikasi password dengan `Hash::check()`
3. Jika match: Set session `casisbas_id`
4. Jika tidak match: Redirect kembali dengan error

**Error Handling:**
```json
{
  "error": "Email atau password salah"
}
```

---

### **2. Dashboard Calon Siswa**

**Lokasi:** `PendaftaranLoginController@index()`

**Route:** `GET /pmb/dashboard`

**Proses:**
1. Ambil `casisbas_id` dari session
2. Query data calon siswa dengan relasi: `provinsi`, `kabupaten`, `tempatLahirProvinsi`, `tempatLahirKabupaten`, `agama`
3. Return view dengan data calon siswa

**Data yang Ditampilkan:**
- Nama lengkap
- Email
- Nomor HP
- Tanggal lahir & tempat lahir
- Alamat saat ini
- Status penerimaan (menunggu/diterima/ditolak)
- Catatan dari admin

---

### **3. Pengisian Data Diri Lengkap**

**Lokasi:** `PendaftaranLoginController@dataDiri()` | `editDataDiri()` | `updateDataDiri()`

#### View Data:
```php
GET /pmb/data-diri
```

**Query Data:**
```php
$casis = Casisbas::with([
    'provinsi', 'kabupaten', 
    'tempatLahirProvinsi', 'tempatLahirKabupaten', 
    'agama'
])->findOrFail($casisbas_id);
```

**Load Dynamic Regencies:**
```php
if ($casis->provinsi_id) {
    $regencies = Regency::where('province_id', $casis->provinsi_id)
        ->orderBy('name')->get();
}

if ($casis->tempat_lahir_provinsi_id) {
    $tempatLahirRegencies = Regency::where('province_id', $casis->tempat_lahir_provinsi_id)
        ->orderBy('name')->get();
}
```

#### Update Data:
```php
POST /pmb/data-diri/update
```

**Validasi Detail:**

| Field | Tipe | Rules |
|-------|------|-------|
| `alamat_ktp` | String | Required, max 255 |
| `alamat_saat_ini` | String | Required, max 255 |
| `kecamatan` | String | Required, max 100 |
| `provinsi_id` | Integer | Required, exists in provinces |
| `kabupaten_id` | Integer | Required, exists in regencies dengan province_id sesuai |
| `nomor_telepon` | String | Nullable, regex `/^[0-9]+$/`, max 20 |
| `no_hp` | String | Required, regex `/^[0-9]+$/`, max 20 |
| `kewarganegaraan` | Enum | Required, in: WNI Asli / WNI Keturunan / WNA |
| `negara_wna` | String | Nullable, required_if kewarganegaraan=WNA |
| `tanggal_lahir` | Date | Required, format date |
| `tempat_lahir_provinsi_id` | Integer | Nullable, exists in provinces |
| `tempat_lahir_kabupaten_id` | Integer | Nullable, exists in regencies |
| `tempat_lahir_negara` | String | Nullable, max 150 |
| `jenis_kelamin` | Enum | Required, in: Pria / Wanita |
| `status_menikah` | Enum | Required, in: Belum menikah / Menikah / Lain-lain |
| `religion_id` | Integer | Required, exists in religions |

**Custom Validasi Tempat Lahir:**

```php
// Harus ada SALAH SATU:
// 1. Provinsi + Kabupaten di Indonesia
// 2. ATAU Negara (lahir di luar negeri)

if (!$hasTempLahirProvinsi && !$hasTempLahirNegara) {
    throw ValidationException: "Provinsi atau negara harus diisi"
}

// Jika ada provinsi, harus ada kabupaten
if ($hasTempLahirProvinsi && !$tempat_lahir_kabupaten_id) {
    throw ValidationException: "Kabupaten harus diisi"
}

// Jika ada negara, tidak boleh ada provinsi
if ($hasTempLahirNegara && $hasTempLahirProvinsi) {
    throw ValidationException: "Tidak boleh isi provinsi jika lahir di luar negeri"
}
```

**Proses Update:**
1. Validasi semua field
2. Clear field yang tidak digunakan (negara_wna, tempat_lahir_kabupaten_id sesuai pilihan)
3. Update record di tabel `casisbas`
4. Redirect ke halaman data diri dengan success message

---

### **4. AJAX: Get Regencies Berdasarkan Province**

**Lokasi:** `PendaftaranLoginController@getRegenciesByProvince()`

```php
GET /pmb/regencies/{province}
```

**Response JSON:**
```json
[
  { "id": 1, "name": "Kabupaten Sleman" },
  { "id": 2, "name": "Kabupaten Bantul" },
  ...
]
```

---

### **5. Status Pendaftaran**

**Lokasi:** `PendaftaranLoginController@statusPendaftaran()`

```php
GET /pmb/status-pendaftaran
```

**Data yang Ditampilkan:**
- Status penerimaan: `menunggu` / `diterima` / `ditolak`
- Catatan dari admin
- Status kelengkapan data

---

### **6. Cetak Bukti Pendaftaran PDF**

**Lokasi:** `PendaftaranLoginController@cetakBukti()`

```php
GET /pmb/cetak-bukti
```

**Proses:**
1. Ambil data calon siswa dari session
2. Load relasi: `provinsi`, `kabupaten`, `agama`
3. Generate PDF dengan `Barryvdh\DomPDF`
4. Return PDF stream ke browser

**Isi PDF:**
- Nama lengkap
- Email
- Tanggal lahir
- Tempat lahir
- Alamat saat ini
- Agama
- Provinsi/Kabupaten
- Timestamp cetak

---

### **7. Logout**

**Lokasi:** `PendaftaranLoginController@logout()`

```php
POST /pmb/logout
```

**Proses:**
1. Forget session `casisbas_id`
2. Redirect ke login form

---

## 👨‍💼 Fitur Administrator

### **1. Daftar Calon Siswa**

**Lokasi:** `Admin/PendaftaranAdminController@calonSiswa()`

```php
GET /admin/pendaftaran/calon-siswa
```

**Query Base:**
```php
Casisbas::with(['provinsi', 'kabupaten', 'agama'])
    ->orderByDesc('created_at')
```

**Filter & Search:**

#### Search:
```php
if ($request->filled('search')) {
    $query->where(function ($q) use ($search) {
        $q->where('nama_lengkap', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%")
          ->orWhere('no_hp', 'like', "%{$search}%");
    });
}
```

#### Filter Kelengkapan Data:

**Lengkap:**
```php
if ($request->kelengkapan === 'lengkap') {
    $query->whereNotNull('jenis_kelamin')
        ->whereNotNull('status_menikah')
        ->whereNotNull('religion_id')
        ->whereNotNull('alamat_saat_ini')
        ->whereNotNull('kecamatan')
        ->whereNotNull('kabupaten_id')
        ->whereNotNull('provinsi_id')
        ->whereNotNull('tanggal_lahir')
        ->whereNotNull('tempat_lahir')
        ->whereNotNull('kewarganegaraan');
}
```

**Belum Lengkap:**
```php
if ($request->kelengkapan === 'belum_lengkap') {
    $query->where(function ($q) {
        $q->whereNull('jenis_kelamin')
          ->orWhereNull('status_menikah')
          ...semua field krusial...
    });
}
```

**Pagination:** 20 items per page

---

### **2. Detail Calon Siswa dengan Analisis Kelengkapan**

**Lokasi:** `Admin/PendaftaranAdminController@showCalonSiswa()`

```php
GET /admin/pendaftaran/calon-siswa/{id}
```

**Proses:**
1. Load data calon siswa dengan relasi lengkap
2. Hitung kelengkapan field:
   ```php
   $kelengkapan = [
       'Nama Lengkap' => !empty($casis->nama_lengkap),
       'Email' => !empty($casis->email),
       'No HP' => !empty($casis->no_hp),
       'Jenis Kelamin' => !empty($casis->jenis_kelamin),
       'Status Menikah' => !empty($casis->status_menikah),
       'Agama' => !empty($casis->religion_id),
       'Alamat KTP' => !empty($casis->alamat_ktp),
       'Alamat Saat Ini' => !empty($casis->alamat_saat_ini),
       'Kecamatan' => !empty($casis->kecamatan),
       'Kabupaten' => !empty($casis->kabupaten_id),
       'Provinsi' => !empty($casis->provinsi_id),
       'Kewarganegaraan' => !empty($casis->kewarganegaraan),
       'Tanggal Lahir' => !empty($casis->tanggal_lahir),
       'Tempat Lahir Provinsi' => !empty($casis->tempat_lahir_provinsi_id),
   ];
   ```

3. Hitung persentase:
   ```php
   $totalField = count($kelengkapan); // 15 field
   $terisiField = collect($kelengkapan)->filter()->count();
   $persentase = ($terisiField / $totalField) * 100; // 0-100%
   ```

**Output:**
```json
{
  "totalField": 15,
  "terisiField": 12,
  "persentase": 80,
  "kelengkapan": {
    "Nama Lengkap": true,
    "Email": true,
    ...
  }
}
```

---

### **3. Edit Data Calon Siswa**

#### Get Form:
```php
GET /admin/pendaftaran/calon-siswa/{id}/edit
```

**Lokasi:** `Admin/PendaftaranAdminController@editDataCalonSiswaForm()`

**Load Data:**
1. Calon siswa dengan semua relasi
2. Daftar provinces
3. Daftar regencies untuk provinsi yang dipilih
4. Daftar tempat lahir regencies
5. Daftar religions

#### Update:
```php
PUT /admin/pendaftaran/calon-siswa/{id}
```

**Lokasi:** `Admin/PendaftaranAdminController@editDataCalonSiswa()`

**Validasi:**
- Sama dengan validasi calon siswa (dari `updateDataDiri`), tapi semua field NULLABLE
- Email unique kecuali untuk user yang sama (ignore)
- Password optional dengan konfirmasi

**Proses:**
1. Validasi data
2. Handle conditional: jika kewarganegaraan != WNA, clear `negara_wna`
3. Handle conditional: jika tidak ada `provinsi_id`, clear `kabupaten_id`
4. Handle conditional: jika tidak ada `tempat_lahir_provinsi_id`, clear `tempat_lahir_kabupaten_id`
5. Hash password jika ada yang baru
6. Update record
7. Redirect ke detail dengan success message

---

### **4. Hapus Data Calon Siswa**

```php
DELETE /admin/pendaftaran/calon-siswa/{id}
```

**Lokasi:** `Admin/PendaftaranAdminController@hapusDataCalonSiswa()`

**Proses:**
1. Cari record calon siswa
2. Delete record dari tabel `casisbas`
3. Redirect ke daftar calon siswa

---

### **5. Daftar Pendaftaran Siswa (Formal)**

**Lokasi:** `Admin/PendaftaranAdminController@index()`

```php
GET /admin/pendaftaran
```

**Query Base:**
```php
Pendaftaran::with('jurusan')->orderBy('created_at', 'desc')
```

**Filter:**

```php
if ($request->filled('status_pembayaran')) {
    // pending, paid, failed, expired
    $query->where('status_pembayaran', $request->status_pembayaran);
}

if ($request->filled('status_pendaftaran')) {
    // draft, menunggu_pembayaran, verifikasi_dokumen, diterima, ditolak
    $query->where('status_pendaftaran', $request->status_pendaftaran);
}
```

**Search:**
```php
if ($request->filled('search')) {
    $query->where(function($q) use ($search) {
        $q->where('nama_lengkap', 'like', "%{$search}%")
          ->orWhere('nisn', 'like', "%{$search}%")
          ->orWhere('kode_pendaftaran', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
    });
}
```

**Pagination:** 20 items per page

---

### **6. Detail Pendaftaran**

```php
GET /admin/pendaftaran/{id}
```

**Lokasi:** `Admin/PendaftaranAdminController@show()`

**Data yang Ditampilkan:**
- Info siswa: nama, NISN, email, no HP, tempat lahir, tanggal lahir, jenis kelamin, alamat
- Info orang tua: nama ayah, ibu, wali, pekerjaan, no HP, alamat
- Info sekolah asal: nama sekolah, alamat, tahun lulus, rata-rata nilai
- Info pendaftaran: jurusan, prestasi, alasan memilih
- Status: pembayaran, pendaftaran
- File dokumen: ijazah, akta, KK, foto, KIP, KTP, bukti pembayaran
- Catatan admin

---

### **7. Update Status Pendaftaran**

```php
PUT /admin/pendaftaran/{id}/status
```

**Lokasi:** `Admin/PendaftaranAdminController@updateStatus()`

**Validasi:**
```php
'status_pendaftaran' => 'in:draft,menunggu_pembayaran,verifikasi_dokumen,diterima,ditolak',
'status_pembayaran' => 'in:pending,paid,failed,expired',
'catatan_admin' => 'nullable|string'
```

**Logika Update:**
```php
$updateData = [
    'status_pendaftaran' => $request->status_pendaftaran,
    'status_pembayaran' => $request->status_pembayaran,
    'catatan_admin' => $request->catatan_admin,
];

// Jika status pembayaran berubah ke 'paid', set timestamp paid_at
if ($request->status_pembayaran == 'paid' && !$pendaftaran->paid_at) {
    $updateData['paid_at'] = now();
}
```

---

### **8. Download Dokumen**

```php
GET /admin/pendaftaran/{id}/download/{type}
```

**Lokasi:** `Admin/PendaftaranAdminController@downloadDocument()`

**Tipe Dokumen:**
```php
$filePath = match($type) {
    'ijazah' => $pendaftaran->ijazah_path,
    'akta' => $pendaftaran->akta_kelahiran_path,
    'kk' => $pendaftaran->kartu_keluarga_path,
    'foto' => $pendaftaran->pas_foto_path,
    'kip' => $pendaftaran->kip_path,
    'ktp' => $pendaftaran->ktp_ortu_path,
    'bukti_pembayaran' => $pendaftaran->bukti_pembayaran_path,
    default => null,
};
```

**Proses:**
1. Validasi file exists di storage
2. Return response download dengan type detection

---

### **9. Export ke CSV**

```php
GET /admin/pendaftaran/export
```

**Lokasi:** `Admin/PendaftaranAdminController@export()`

**Header CSV:**
```
Kode Pendaftaran, NISN, Nama Lengkap, Email, No HP, Tempat Lahir, Tanggal Lahir, 
Jenis Kelamin, Alamat, Nama Ayah, Pekerjaan Ayah, Nama Ibu, Pekerjaan Ibu, 
Nama Wali, No HP Ortu, Alamat Ortu, Sekolah Asal, Alamat Sekolah, Tahun Lulus, 
Rata-rata Nilai, Jurusan, Prestasi, Alasan Memilih, Status Pembayaran, 
Status Pendaftaran, Tanggal Daftar
```

**Filter:** Sama dengan filter di index (status pembayaran, status pendaftaran)

---

### **10. Delete Pendaftaran**

```php
DELETE /admin/pendaftaran/{id}
```

**Lokasi:** `Admin/PendaftaranAdminController@destroy()`

**Proses:**
1. Cari record pendaftaran
2. Hapus semua file dokumen dari storage:
   - ijazah_path
   - akta_kelahiran_path
   - kartu_keluarga_path
   - pas_foto_path
   - ktp_ortu_path
   - kip_path
   - bukti_pembayaran_path
3. Delete record dari tabel `pendaftarans`
4. Redirect ke daftar pendaftaran

---

### **11. Update Status Penerimaan Calon Siswa**

```php
GET /admin/pendaftaran/calon-siswa/{id}/status/form
POST /admin/pendaftaran/calon-siswa/{id}/status/update
```

**Lokasi:** 
- Form: `Admin/PendaftaranAdminController@statusCalonSiswaForm()`
- Update: `Admin/PendaftaranAdminController@updateStatusCalonSiswa()`

**Validasi:**
```php
'status_penerimaan' => 'in:menunggu,diterima,ditolak',
'catatan_penerimaan' => 'nullable|string|max:1000'
```

**Update:**
```php
$casis->update([
    'status_penerimaan' => $request->status_penerimaan,
    'catatan_penerimaan' => $request->catatan_penerimaan,
]);
```

---

## 🗄️ Model Data & Database

### **1. Model Casisbas (Calon Siswa)**

**File:** `App\Models\Casisbas`

**Tabel:** `casisbas`

**Fields:**
```php
protected $fillable = [
    'nama_lengkap',
    'email',
    'no_hp',
    'password',
    'alamat_ktp',
    'alamat_saat_ini',
    'kecamatan',
    'kabupaten_id',
    'provinsi_id',
    'nomor_telepon',
    'kewarganegaraan', // WNI Asli / WNI Keturunan / WNA
    'negara_wna',
    'tanggal_lahir',
    'tempat_lahir',
    'tempat_lahir_negara',
    'tempat_lahir_provinsi_id',
    'tempat_lahir_kabupaten_id',
    'jenis_kelamin', // Pria / Wanita
    'status_menikah', // Belum menikah / Menikah / Lain-lain
    'religion_id',
    'status_penerimaan', // menunggu / diterima / ditolak
    'catatan_penerimaan',
];
```

**Relations:**
```php
public function provinsi() {}           // belongsTo Provinces
public function kabupaten() {}          // belongsTo Regency
public function tempatLahirProvinsi() {} // belongsTo Provinces
public function tempatLahirKabupaten() {} // belongsTo Regency
public function agama() {}              // belongsTo Religion
```

**Migration:** `2026_04_20_164557_create_casisbas_table.php`

```php
Schema::create('casisbas', function (Blueprint $table) {
    $table->id();
    $table->string('nama_lengkap');
    $table->string('email')->unique();
    $table->string('no_hp')->nullable();
    $table->string('password');
    $table->string('alamat_ktp')->nullable();
    $table->string('alamat_saat_ini')->nullable();
    $table->string('kecamatan')->nullable();
    $table->unsignedBigInteger('kabupaten_id')->nullable();
    $table->unsignedBigInteger('provinsi_id')->nullable();
    $table->string('nomor_telepon')->nullable();
    $table->string('kewarganegaraan')->nullable();
    $table->string('negara_wna')->nullable();
    $table->date('tanggal_lahir')->nullable();
    $table->string('tempat_lahir')->nullable();
    $table->string('tempat_lahir_negara')->nullable();
    $table->enum('jenis_kelamin', ['Pria', 'Wanita'])->nullable();
    $table->enum('status_menikah', ['Belum menikah', 'Menikah', 'Lain-lain'])->nullable();
    $table->unsignedBigInteger('religion_id')->nullable();
    $table->enum('status_penerimaan', ['menunggu', 'diterima', 'ditolak'])
        ->default('menunggu');
    $table->text('catatan_penerimaan')->nullable();
    $table->timestamps();
    
    // Foreign keys
    $table->foreign('provinsi_id')->references('id')->on('provinces')->onDelete('set null');
    $table->foreign('kabupaten_id')->references('id')->on('regencies')->onDelete('set null');
    $table->foreign('religion_id')->references('id')->on('religions')->onDelete('set null');
});
```

---

### **2. Model Pendaftaran (Pendaftaran Formal Siswa)**

**File:** `App\Models\Pendaftaran`

**Tabel:** `pendaftarans`

**Fields:**
```php
protected $fillable = [
    'kode_pendaftaran',      // Auto-generated: REG{YYYYMMDD}{RANDOM6}
    'email',
    'nama_lengkap',
    'tanggal_lahir',
    'tempat_lahir',
    'jenis_kelamin',
    'alamat',
    'no_hp_siswa',
    'nama_ayah',
    'pekerjaan_ayah',
    'nama_ibu',
    'pekerjaan_ibu',
    'nama_wali',
    'no_hp_ortu',
    'alamat_ortu',
    'sekolah_asal',
    'alamat_sekolah_asal',
    'nisn',
    'tahun_lulus',
    'rata_rata_nilai',       // decimal(5,2)
    'jurusan_id',            // FK to jurusans
    'ijazah_path',           // File path
    'akta_kelahiran_path',   // File path
    'kartu_keluarga_path',   // File path
    'pas_foto_path',         // File path
    'kip_path',              // File path (optional)
    'ktp_ortu_path',         // File path
    'bukti_pembayaran_path', // File path (optional)
    'prestasi_ekstrakurikuler',
    'alasan_memilih',
    'biaya_pendaftaran',     // integer
    'status_pembayaran',     // pending / paid / failed / expired
    'status_pendaftaran',    // draft / menunggu_pembayaran / verifikasi_dokumen / diterima / ditolak
    'midtrans_order_id',     // Payment gateway
    'midtrans_transaction_id', // Payment gateway
    'paid_at',               // datetime
    'catatan_admin',         // text
];
```

**Casts:**
```php
protected $casts = [
    'tanggal_lahir' => 'date',
    'tahun_lulus' => 'integer',
    'rata_rata_nilai' => 'decimal:2',
    'biaya_pendaftaran' => 'integer',
    'paid_at' => 'datetime',
];
```

**Auto-generation Code:**
```php
public static function boot()
{
    parent::boot();
    static::creating(function ($pendaftaran) {
        if (empty($pendaftaran->kode_pendaftaran)) {
            $pendaftaran->kode_pendaftaran = self::generateKodePendaftaran();
        }
    });
}

public static function generateKodePendaftaran()
{
    do {
        $kode = 'REG' . date('Ymd') . strtoupper(Str::random(6));
    } while (self::where('kode_pendaftaran', $kode)->exists());
    return $kode;
}
```

**Helper Methods:**
```php
public function isPaid()           // status_pembayaran == 'paid'
public function isDiterima()       // status_pendaftaran == 'diterima'
public function isDitolak()        // status_pendaftaran == 'ditolak'
public function getStatusPembayaranBadgeAttribute() // HTML badge
public function getStatusPendaftaranBadgeAttribute() // HTML badge
```

**Relations:**
```php
public function jurusan() {} // belongsTo Jurusan
```

**Migration:** `2025_10_01_074024_create_pendaftarans_table.php`

---

### **3. Reference Models**

#### **Provinces & Regencies**
- Model: `App\Models\Provinces`, `App\Models\Regency`
- Digunakan untuk: Lokasi Indonesia (provinsi/kabupaten)
- Source: Likely dari seeder atau external API

#### **Religion**
- Model: `App\Models\Religion`
- Digunakan untuk: Pilihan agama
- Fields: `id`, `name`

#### **Jurusan**
- Model: `App\Models\Jurusan`
- Digunakan untuk: Program keahlian di sekolah
- Relation: `Pendaftaran::jurusan()`

---

## 💻 Teknologi yang Digunakan

### Backend:
- **Framework:** Laravel 11
- **Language:** PHP 8.1+
- **Database:** MySQL / MariaDB
- **Authentication:** Session-based (non-API)
- **PDF Generation:** Barryvdh DomPDF

### Frontend:
- **Build Tool:** Vite
- **Styling:** CSS / Tailwind CSS
- **JavaScript:** Vanilla JS / Alpine JS
- **HTTP Client:** Axios / Fetch API

### Development:
- **Testing:** Pest PHP
- **Package Manager:** Composer, NPM/Yarn
- **Version Control:** Git

---

## ⚙️ Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/smktamansiswapwt/tamsis.git
cd smktamansiswapwt.sch.id
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration
Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tamsis_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migrations
```bash
php artisan migrate
php artisan db:seed  # Optional: seed with demo data
```

### 6. Storage Link
```bash
php artisan storage:link
```

### 7. Build Assets
```bash
npm run build    # Production
npm run dev      # Development watch
```

### 8. Run Application
```bash
php artisan serve
```

Akses: `http://localhost:8000`

---

## 🔌 API Endpoints

### **Calon Siswa (PMB)**

| Method | Route | Controller | Purpose |
|--------|-------|----------|---------|
| GET | `/pmb/login` | `showLoginForm()` | Tampil form login |
| POST | `/pmb/login` | `login()` | Proses login |
| GET | `/pmb/register` | `showRegisterForm()` | Tampil form register |
| POST | `/pmb/register` | `register()` | Proses register |
| POST | `/pmb/logout` | `logout()` | Logout |
| GET | `/pmb/dashboard` | `index()` | Dashboard calon siswa |
| GET | `/pmb/data-diri` | `dataDiri()` | Lihat data diri |
| GET | `/pmb/data-diri/edit` | `editDataDiri()` | Edit form data diri |
| POST | `/pmb/data-diri/update` | `updateDataDiri()` | Update data diri |
| GET | `/pmb/regencies/{province}` | `getRegenciesByProvince()` | AJAX: get kabupaten |
| GET | `/pmb/status-pendaftaran` | `statusPendaftaran()` | Lihat status penerimaan |
| GET | `/pmb/cetak-bukti` | `cetakBukti()` | Download PDF bukti |

### **Administrator**

| Method | Route | Controller | Purpose |
|--------|-------|----------|---------|
| GET | `/admin/pendaftaran/calon-siswa` | `calonSiswa()` | Daftar calon siswa |
| GET | `/admin/pendaftaran/calon-siswa/{id}` | `showCalonSiswa()` | Detail calon siswa |
| GET | `/admin/pendaftaran/calon-siswa/{id}/edit` | `editDataCalonSiswaForm()` | Edit form calon siswa |
| PUT | `/admin/pendaftaran/calon-siswa/{id}` | `editDataCalonSiswa()` | Update calon siswa |
| DELETE | `/admin/pendaftaran/calon-siswa/{id}` | `hapusDataCalonSiswa()` | Delete calon siswa |
| GET | `/admin/pendaftaran/calon-siswa/{id}/status/form` | `statusCalonSiswaForm()` | Form update status penerimaan |
| POST | `/admin/pendaftaran/calon-siswa/{id}/status` | `updateStatusCalonSiswa()` | Update status penerimaan |
| GET | `/admin/pendaftaran` | `index()` | Daftar pendaftaran formal |
| GET | `/admin/pendaftaran/{id}` | `show()` | Detail pendaftaran |
| PUT | `/admin/pendaftaran/{id}/status` | `updateStatus()` | Update status pembayaran/pendaftaran |
| GET | `/admin/pendaftaran/{id}/download/{type}` | `downloadDocument()` | Download dokumen |
| DELETE | `/admin/pendaftaran/{id}` | `destroy()` | Delete pendaftaran |
| GET | `/admin/pendaftaran/export` | `export()` | Export CSV |
| GET | `/admin/regencies/{provinceId}` | `getRegenciesByProvince()` | AJAX: get kabupaten |

---

## 🔍 Troubleshooting

### Session Expired / Login Gagal
- Pastikan session driver di `.env` adalah `file` atau `database`
- Clear session: `php artisan cache:clear && php artisan session:flush`
- Pastikan cookies enabled di browser

### File Upload Gagal
- Cek permission folder: `storage/app/public` (755)
- Cek disk configuration di `config/filesystems.php`
- Pastikan storage link sudah dibuat: `php artisan storage:link`

### Relasi Data Kosong
- Cek eager loading di controller (gunakan `with()`)
- Pastikan foreign key dan data di DB konsisten
- Gunakan `withTrashed()` jika menggunakan soft delete

### Email Unique Validation Error
- Gunakan `Rule::unique('table', 'column')->ignore($id)` saat edit
- Clear cache: `php artisan cache:clear`

### Password Hash Mismatch
- Pastikan menggunakan `Hash::check()` saat verifikasi
- Pastikan menggunakan `Hash::make()` saat create/update password
- Jangan gunakan md5() atau plaintext

---

## 📚 Referensi File

- **Controller Calon Siswa:** `app/Http/Controllers/PendaftaranLoginController.php`
- **Controller Admin:** `app/Http/Controllers/Admin/PendaftaranAdminController.php`
- **Model Casisbas:** `app/Models/Casisbas.php`
- **Model Pendaftaran:** `app/Models/Pendaftaran.php`
- **Migration Casisbas:** `database/migrations/2026_04_20_164557_create_casisbas_table.php`
- **Migration Pendaftaran:** `database/migrations/2025_10_01_074024_create_pendaftarans_table.php`

---

## 📞 Support

**SMK Taman Siswa Wapwt**
- 📧 Email: info@smktamansiswapwt.sch.id
- 📱 WhatsApp: [Contact]
- 🌐 Website: https://smktamansiswapwt.sch.id

---

**Versi:** 1.0.0  
**Terakhir Diperbarui:** April 2026  
**Developer:** Tim IT SMK Taman Siswa Wapwt

