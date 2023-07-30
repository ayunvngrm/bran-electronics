<?php
  class UserManager {
    public $IdPengguna;
    public $NamaPengguna;
    public $Password;
    public $NamaDepan;
    public $NamaBelakang;
    public $NoHp;
    public $Alamat;
    public $IdAkses;
    
    function __construct($idPengguna, $namaPengguna, $password, $namaDepan, $namaBelakang, $noHp, $alamat, $idAkses) {
      $this->IdPengguna = $idPengguna;
      $this->NamaPengguna = $namaPengguna;
      $this->Password = $password;
      $this->NamaDepan = $namaDepan;
      $this->NamaBelakang = $namaBelakang;
      $this->NoHp = $noHp;
      $this->Alamat = $alamat;
      $this->IdAkses = $idAkses;
    }
    
    function tambahPengguna($idPengguna, $namaPengguna, $password, $namaDepan, $namaBelakang, $noHp, $alamat, $idAkses) {
      // Fungsi untuk menambahkan data pengguna ke dalam database atau struktur data lainnya
    }
    function cekPassword($idPengguna, $password) {
      // Fungsi untuk memeriksa apakah password yang dimasukkan sesuai dengan password pengguna berdasarkan ID pengguna
    }
  }
?>