<?php
require_once "connect.php";

  class SalesManager {
      private static $lastId = 0;
      private $sales;
      private $database;

      public function __construct() {
          $this->database = new Database();
          $this->sales = array();
      }

      public function addSales($jumlah, $total, $nama_pelanggan, $nama_barang) {
        $conn = $this->database->getConnection();

        $sql = "INSERT INTO `penjualan`( `jumlah_penjualan`, `harga_jual`, `id_pelanggan`, `id_barang`) 
        VALUES ('".$jumlah."','".$total."','".$nama_pelanggan."','".$nama_barang."')";

        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param("iiss", $jumlah, $total, $nama_pelanggan, $nama_barang);
        
        if ($stmt->execute()) {
          header("Location: /bran-electronics/dashboard.php");
        } else {
          echo("failed");
        }
      }

      public function editSales($id_penjualan, $nama_barang,  $nama_pelanggan, $jumlah, $total) {
        $conn = $this->database->getConnection();

        $sql = "UPDATE `penjualan` 
                SET `jumlah_penjualan` = ?, `harga_jual` = ?, `id_pelanggan` = ?, `id_barang` = ? 
                WHERE `id_penjualan` = ?";

        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param("sssss", $jumlah, $total, $nama_pelanggan, $nama_barang, $id_penjualan);
        
        if ($stmt->execute()) {
          header("Location: /bran-electronics/dashboard.php");
        } else {
          echo("failed");
        }
      }

      public function deleteSales($id) {
        $conn = $this->database->getConnection();
        $sql = "DELETE FROM penjualan WHERE id_penjualan = $id";
        $result = $conn->query($sql);
        return $result;
      }

      public function getOneSales($id) {
        if (isset($this->sales[$id])) {
            return $this->sales[$id];
        } else {
            return null;
        }
      }

      public function getAllSales() {
          $conn = $this->database->getConnection();
          $sql = "SELECT *, nama_barang 
                  FROM penjualan p
                  JOIN barang b ON b.id_barang = p.id_barang";
          $result = $conn->query($sql);

          $salesData = array();

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $salesData[] = $row;
            }
          }

          return $salesData;
      }

      public function getProfitSales() {
        $conn = $this->database->getConnection();
        $sql = "SELECT b.nama_barang, p.harga_jual, e.harga_beli, (p.harga_jual - e.harga_beli) as keuntungan, 
        CASE
        WHEN (p.harga_jual - e.harga_beli) >= 0 THEN 'Profit'
        ELSE 'Loss'
        END AS status
        from barang b 
        left join penjualan p on b.id_barang = p.id_barang 
        left join pembelian e on b.id_barang = e.id_barang";
        $result = $conn->query($sql);

        $salesData = array();

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $salesData[] = $row;
          }
        }

        return $salesData;
    }
    
  }
?>