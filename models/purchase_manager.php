<?php 
  class PurchaseManager {
      public $IdPembelian;
      public $JumlahPembelian;
      public $HargaBeli;
      public $IdPengguna;

      function __construct($idPembelian, $jumlahPembelian, $hargaBeli, $idPengguna) {
          $this->IdPembelian = $idPembelian;
          $this->JumlahPembelian = $jumlahPembelian;
          $this->HargaBeli = $hargaBeli;
          $this->IdPengguna = $idPengguna;
      }

      function tambahPembelian($idPembelian, $jumlahPembelian, $hargaBeli, $idPengguna) {
          // Fungsi untuk menambahkan data pembelian ke dalam database atau struktur data lainnya
      }
      function hapusPembelian($idPembelian) {
          // Fungsi untuk menghapus data pembelian dari database atau struktur data lainnya berdasarkan ID pembelian
      }
      function getTotalHarga() {
          // Fungsi untuk menghitung total harga seluruh pembelian pada objek ini (jumlahPembelian * HargaBeli)
      }
  }
?>
