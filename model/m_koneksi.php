<?php
//untuk berhubungan dengan database

class m_koneksi
{ //sesuaikan dengan nama file
    //private agar bisa diakses oleh class itu sendiri
    private $host = "localhost", // jangan pakai spasi, harus localhost
        $username = "root",
        $pass = "", // di hp paswordnya root
        $db = "perpustakaan_kel6"; //sesuaikan dengan nama database

    public $koneksi;

    //membuat konstrak yang dimana fungsi ini akan dijalankan otomatis ketika kita membuat objek dari kelas koneksi
    function __construct()
    {
        //untuk menghubungkan file php dengan databse yang kita gunakan
        $this->koneksi = mysqli_connect(
            $this->host,
            $this->username,
            $this->pass,
            $this->db
        );
        //mengecek properti koneksi berhasil atau gagal
        if ($this->koneksi) {
            // echo "koneksi ke database " . $this->db . " berhasil<br>";
            //menegembalikan nilai true jika koneksi ke database berasil
            // tidak perlu pakai return di constructor, cukup simpan di $this->koneksi
        } else {
            //memunculkan pesan error jika koneksi kedatabse gagal
            die("koneksi ke database gagal : " . mysqli_connect_error());
        }
    }
}
