# 🚀 FlightPHP Simple REST API with PDO

API ringan dan cepat menggunakan [Flight PHP Microframework](http://flightphp.com/) + PDO.  
Cocok untuk belajar REST API, CRUD data, dan benchmark performa dengan data besar (hingga 100.000+ row).

---

## 📁 Struktur File

```
.
├── flight/             # Core framework FlightPHP
├── config.php          # Koneksi database via PDO
├── function.php        # Fungsi bisnis (insert, get, detail)
├── index.php           # Routing utama (Flight::route)
├── .htaccess           # Rewrite ke index.php (untuk Apache)
```

---

## ⚙️ Instalasi

1. Clone repo:

   ```bash
   git clone https://github.com/SaichulHuda95/flight-api.git
   cd flight-api
   ```

2. Buat database dan tabel `transaksi`:

   ```sql
   CREATE TABLE transaksi (
       id SERIAL PRIMARY KEY,
       kode_transaksi VARCHAR(20) UNIQUE,
       nama_pelanggan VARCHAR(100),
       total INT,
       status VARCHAR(20)
   );
   ```

3. Atur koneksi DB di `config.php`:

   ```php
   $pdo = new PDO("mysql:host=localhost;dbname=namadb", "user", "password");
   ```

4. Jalankan via browser atau Postman:
   ```
   http://localhost/flight-api/index.php
   ```

---

## 📌 Endpoint yang Tersedia

| Method | Endpoint           | Deskripsi                               |
| ------ | ------------------ | --------------------------------------- |
| GET    | `/`                | Tes koneksi API                         |
| GET    | `/get_data`        | Ambil seluruh data transaksi            |
| GET    | `/get_data_detail` | Ambil detail transaksi (by query param) |
| POST   | `/insert_data`     | Bulk insert 50.000+ data dummy          |
| POST   | `/data_json`       | Terima data via JSON body               |
| POST   | `/form_data`       | Terima data via `form-data`             |

---

## 📥 Contoh Request

### 🔸 `POST /data_json`

```json
{
  "kode_transaksi": "TRX00000123",
  "nama_pelanggan": "Budi"
}
```

### 🔸 `POST /form_data`

`Content-Type: multipart/form-data`

```
kode_transaksi=TRX00000123
nama_pelanggan=Budi
```

### 🔸 `GET /get_data_detail`

```
http://localhost/flight-api/index.php/get_data_detail?kode_transaksi=TRX00000123
```

---

## 🛡️ Fitur

- ✅ Microframework minimalis, cepat
- ✅ PDO + try-catch + transaksi
- ✅ JSON response rapih
- ✅ Bisa handle 100.000+ row
- ✅ Clean code, mudah dikembangkan

---

## 🤝 Kontribusi

Pull request & bintang sangat diterima 🌟  
Silakan fork & kembangkan lebih jauh jadi RESTful API full CRUD.

---

## 🧑‍💻 Author

Made with ❤️ by [saichul huda](https://github.com/SaichulHuda95)

---

## 📄 License

MIT License
