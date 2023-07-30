<?php
  require_once "../models/sales_manager.php";

  $nama_barang = $_POST["nama_barang"];
  $id_penjualan = $_POST["id_penjualan"];
  $nama_pelanggan = $_POST["nama_pelanggan"];
  $jumlah = $_POST["jumlah"];
  $total = $_POST["total"];

  $salesManager = new SalesManager();
  $salesManager->editSales($id_penjualan, $nama_barang,  $nama_pelanggan, $jumlah, $total);
?>