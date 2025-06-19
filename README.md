> ⚠️ Informasi: Repository ini telah diarsipkan secara publik dan tidak akan menerima pembaruan lebih lanjut. Saat ini saya sedang fokus pada kegiatan kuliah dan magang, sehingga pengembangan proyek ini terpaksa saya hentikan dan tidak akan saya lanjutkan di kemudian hari. Saya menyadari bahwa aplikasi ini masih jauh dari sempurna dan belum menerapkan beberapa best practice, seperti struktur folder yang baik, standar keamanan, arsitektur sistem, serta penomoran versi yang konsisten. Mohon dimaklumi, dan semoga repository ini tetap bisa memberikan manfaat sebagai referensi atau bahan pembelajaran.

## Antrian 🏥

Saya membangun aplikasi web ini untuk Anda jika Anda mencari sebuah referensi aplikasi web antrian. Aplikasi ini layaknya pada aplikasi antrian di rumah sakit seperti memanggil loket antrian menggunakan suara. Dengan antarmuka yang sederhana menggunakan template sb admin 2, aplikasi ini memungkinkan pengelolaan antrian secara efisien dan dapat disesuaikan dengan berbagai kebutuhan institusi atau bisnis Anda.  

Aplikasi web ini hanya terdapat admin saja untuk mengelola antrian pasien. Untuk masuk ke sistem gunakan username **admin_antrian_rs** dan password **Antr!anR$1234Secure**. Semoga aplikasi ini dapat memberikan inspirasi dan solusi dalam pengembangan sistem antrian yang lebih efektif.

## Fitur 📱

Untuk fitur, mohon Anda bisa melihat pada <a href="https://github.com/galihap76/antrian/releases/">rilis aplikasi</a>.

## Install ⚙️

Jika Anda ingin menggunakan aplikasi web ini, cara nya cukup mudah. Ikuti langkah langkah ini :

1. Lakukan git clone :
```
git clone https://github.com/galihap76/antrian.git
```
 
2. Import database nya yang berada pada folder **assets/** pada nama file database **db_antrian.sql**.

3. Lalu Anda sudah bisa mencoba aplikasi web nya dengan mengakses URL :
```
http://localhost/antrian/login.php
```

4. Selesai.

## Screenshots 📸

| ![image](https://github.com/user-attachments/assets/935455cf-5c0a-43c4-913b-6b607fe3c35a) | ![image](https://github.com/user-attachments/assets/8cebab0e-8044-402b-a217-786b67ca4bc5)
| ------------------------------------------------------------ | ------------------------------------------------------------ |
| Login                                        | Dashboard                      |
| ![image](https://github.com/user-attachments/assets/9d700efe-0fcd-4e33-a5d6-594d8787fc7e) | ![image](https://github.com/user-attachments/assets/a7f59e35-5f0c-48be-b550-b3d4570cf886)
| Tambah Antrian                                        | Hapus Antrian                      |
| ![image](https://github.com/user-attachments/assets/2c7d4046-8dcd-46c6-aa59-613e1245168b) | ![image](https://github.com/user-attachments/assets/9d93f7d4-f35d-4fbc-bb80-b2e6a3e790e6)
|  Panggilan Manual                                        | Panggil Antrian                      |
| ![image](https://github.com/user-attachments/assets/af49aa1a-c051-4e46-b408-b08a993851e6) | ![image](https://github.com/user-attachments/assets/49ddae15-b412-43e3-bb22-65007262db77)
| Panggil Ulang Antrian | Ganti Password

## Voice 🔊

Pada sistem voice, saya menggunakan API yang berbeda yaitu menggunakan API bawahan browser google chrome dan API eksternal pada <a href="https://responsivevoice.org/">responsivevoice.org</a>. Alasan kenapa saya menggunakan API yang berbeda, karena API bawahan browser google chrome tidak tersedia pada browser lain.

Jadi, saya harus menggunakan API eksternal untuk mendukung browser lain agar pemanggilan suara antrian bisa bekerja pada semua browser. Kekurangan menggunakan API eksternal yang saya pakai secara gratis terkadang bisa delay untuk pemanggilan antrian. Saya sarankan gunakan browser google chrome untuk menjalankan aplikasi web antrian ini agar cepat memanggil antrian.

## Penutup

Perlu diingat kembali bahwa aplikasi web ini dirancang sebagai referensi bagi seseorang yang sedang mencari contoh aplikasi antrian. Anda diperbolehkan untuk mengubah source code ini, termasuk mengubah struktur folder. Saya merekomendasikan agar Anda mempertimbangkan untuk mengubahnya menjadi arsitektur MVC menggunakan PHP native agar lebih optimal.

Karena aplikasi web ini masih memiliki beberapa kekurangan, saya akan melakukan pembaruan jika ada waktu. Aplikasi ini dibangun menggunakan PHP versi 8.2, jadi pastikan untuk menyesuaikan versi PHP di lingkungan Anda. Jika Anda memiliki pertanyaan silakan tekan tombol <a href="https://github.com/galihap76/antrian/issues">issues</a>. Terima kasih.

