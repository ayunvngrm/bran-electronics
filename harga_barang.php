<?php

require_once "connection.php";
$id = $_GET["harga"];

 $sqlSales = "SELECT * from
 barang  where id_barang =".$id;
$resultSales = $mysqli->query($sqlSales);

while ($row = $resultSales->fetch_assoc()){
  echo $harga = $row["harga_jual"];
}

?>