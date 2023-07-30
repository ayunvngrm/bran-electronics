<?php
  require_once "../models/connect.php";

  $nama_barang = $_POST["nama_barang"];
  $nama_pelanggan = $_POST["nama_pelanggan"];
  $jumlah = $_POST["jumlah"];
  $total = $_POST["total"];

  $database = new Database();
  $conn = $database->getConnection();

  $sql = "INSERT INTO `penjualan`( `jumlah_penjualan`, `harga_jual`, `id_pelanggan`, `id_barang`) 
  VALUES ('".$jumlah."','".$total."','".$nama_pelanggan."','".$nama_barang."')";
  
  $conn->query($sql);
  
  header("Location: /tugas3/dashboard.php");  
?>