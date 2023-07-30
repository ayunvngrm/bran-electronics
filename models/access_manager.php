<?php
  class HakAkses {
      public $IdAkses;
      public $NamaAkses;
      public $Keterangan;

      function __construct($idAkses, $namaAkses, $keterangan) {
          $this->IdAkses = $idAkses;
          $this->NamaAkses = $namaAkses;
          $this->Keterangan = $keterangan;
      }

      function tambahHakAkses($idAkses, $namaAkses, $keterangan) {
          // Fungsi untuk menambahkan data hak akses ke dalam database atau struktur data lainnya
      }
      function updateKeterangan($idAkses, $keterangan) {
          // Fungsi untuk mengupdate keterangan hak akses berdasarkan ID akses
      }
  }
?>