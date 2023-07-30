<?php
  class Barang {
      public $IdBarang;
      public $NamaBarang;
      public $Keterangan;
      public $Satuan;
      public $Stock;
      function __construct($idBarang, $namaBarang, $keterangan, $satuan, $stock) {
          $this->IdBarang = $idBarang;
          $this->NamaBarang = $namaBarang;
          $this->Keterangan = $keterangan;
          $this->Satuan = $satuan;
          $this->Stock = $stock;
      }
    
      function tambahBarang($idBarang, $namaBarang, $keterangan, $satuan, $stock) {
          // Fungsi untuk menambahkan data barang ke dalam database atau struktur data lainnya
      }
      function updateStock($idBarang, $quantity) {
          // Fungsi untuk mengupdate jumlah stock barang berdasarkan ID barang
      }
  }
?>
