# TP8DPBO2425C2

## Janji

Saya Nafis Asyakir Anjar dengan NIM 2407915 mengerjakan Tugas Praktikum 8 pada Mata Kuliah Desain dan Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

## Desain Program

<img width="466" height="439" alt="image" src="https://github.com/user-attachments/assets/285762e7-1e75-4d32-ad25-5974a3506d32" />

#### 📄 1. Table: lecturers

Menyimpan data dosen yang mengajar mata kuliah tertentu.

**Atribut**
| Atribut      | Tipe Data    | Keterangan                  |
| ------------ | ------------ | --------------------------- |
| `id`         | int(11)      | Primary Key, Auto Increment |
| `name`       | varchar(100) | Nama dosen                  |
| `nidn`       | varchar(20)  | Nomor Induk Dosen Nasional  |
| `phone`      | varchar(15)  | Nomor telepon               |
| `join_date`  | date         | Tanggal mulai bekerja       |
| `created_at` | timestamp    | Waktu data dibuat           |
| `subject_id` | int(11)      | Foreign Key → subjects.id   |


Setiap lecturer mengajar 1 subject
→ lecturers.subject_id → subjects.id

#### 📄 2. Table: subjects

Menyimpan daftar mata kuliah beserta detailnya.

**Atribut**
| Atribut        | Tipe Data    | Keterangan              |
| -------------- | ------------ | ----------------------- |
| `id`           | int(11)      | Primary Key             |
| `name`         | varchar(100) | Nama mata kuliah        |
| `credits`      | int(11)      | Jumlah SKS              |
| `subject_code` | varchar(20)  | Kode mata kuliah        |
| `major_id`     | int(11)      | Foreign Key → majors.id |
| `created_at`   | timestamp    | Waktu data dibuat       |

**Relasi**

Setiap subject dimiliki oleh 1 major
→ subjects.major_id → majors.id

Satu subject dapat diajar oleh banyak lecturers (one-to-many)

#### 📄 3. Table: majors

Menyimpan informasi tentang jurusan/program studi.

**Atribut**
| Atribut            | Tipe Data    | Keterangan        |
| ------------------ | ------------ | ----------------- |
| `id`               | int(11)      | Primary Key       |
| `name`             | varchar(100) | Nama jurusan      |
| `established_year` | year(4)      | Tahun berdiri     |
| `student_count`    | int(11)      | Jumlah mahasiswa  |
| `created_at`       | timestamp    | Waktu data dibuat |

**Relasi**
Satu major memiliki banyak subjects (one-to-many)
→ majors.id → subjects.major_id

🔗 Relasi

majors (1) —— (∞) subjects (1) —— (∞) lecturers

Major → Subjects : One to Many
Subject → Lecturers : One to Many

## Fitur Yang Tersedia

1. **CRUD Lecturer**  : User dapat menambah, mengedit, dan menghapus data pada tabel Lecturer
2. **CRUD Subject**   : User dapat menambah, mengedit, dan menghapus data pada tabel Subject
3. **CRUD Major**     : User dapat menambah, mengedit, dan menghapus data pada tabel Major

## Alur Program

1. User membuka URL di browser dan mengirim request ke server.
2. Router di index.php menerima request dan menentukan halaman serta aksi yang dituju.
3. View yang sesuai dimuat untuk menampilkan antarmuka kepada user.
4. User mengisi form dan menekan tombol submit untuk mengirim data.
5. Browser mengirim data form melalui HTTP POST request ke server.
6. Controller menerima data, memvalidasi, dan memanggil model untuk pemrosesan.
7. Model berinteraksi dengan database untuk melakukan operasi CRUD.
8. Controller melakukan redirect ke halaman lain setelah pemrosesan selesai.
9. View menampilkan hasil terbaru dan pesan sukses/error kepada user.
10. Jika terjadi error, sistem menangani exception dan memberi feedback tanpa crash.

## Dokumentasi



https://github.com/user-attachments/assets/a7bcf379-e576-47df-a309-9565917ef83d


