<!DOCTYPE html>

<?php
  require_once "connection.php";

  $id_penjualan = $_GET["id_penjualan"];
  $sqlSales = "SELECT *
                 FROM penjualan p
                 where id_penjualan = ".$id_penjualan;
    $resultSales = $mysqli->query($sqlSales); 
    while ($row_penjualan = $resultSales->fetch_assoc()){
        $id_pelanggan    =   $row_penjualan["id_pelanggan"];
        $id_barang      =   $row_penjualan["id_barang"];
        $jumlah_penjualan    =   $row_penjualan["jumlah_penjualan"];
        $harga_jual    =   $row_penjualan["harga_jual"];
    }

  if (isset($_SESSION['valid_token'])) {
    $sqlSales = "SELECT *, nama_barang 
                 FROM penjualan p
                 JOIN barang b ON b.id_barang = p.id_barang";
    $resultSales = $mysqli->query($sqlSales);
    $nama_pengguna = "";
    $access = "";

    if (isset($_SESSION['nama_pengguna'])) {
      $nama_pengguna = $_SESSION['nama_pengguna'];
    }
    
    if (isset($_SESSION['access'])) {
      $access = strtolower($_SESSION['access']);
    }
  } else {
    session_destroy();
    header("Location: index.php");
    exit();
  }

  if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
  }
?>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/dash.css">
    <title>Edit Penjualan</title>
  </head>

  <body>
    <input type="checkbox" name="" id="menu-toggle">
    <div class="sidebar">
      <div class="sidebar-container">
        <div>
          <div class="brand">
            <h3>
              <span class="lab la-staylinked"></span>
              bran.
            </h3>
          </div>

          <p class="brand-desc">Your electronics solutions</p>
          <div class="sidebar-menu">
            <ul>
              <li><a href="#"><span class="las la-adjust"></span><span>Dashboard</span></a></li>
              <li><a href="dashboard.php"><span class="las la-video"></span><span>Sales</span></a></li>
              <li><a href="#"><span class="las la-chart-bar"></span><span>Purchases</span></a></li>
              <li><a href="#"><span class="las la-calendar"></span><span>Analytics</span></a></li>
            </ul>
          </div>
        </div>

        <div>
        <button id="logoutButton" onclick="logout()">Logout<button>
        </div>
      </div>
    </div>
    <div class="main-content">
      <header>
        <div class="header-wrapper">
          <div class="header-title">
            <h1>Edit Sales</h1>
          </div>
        </div>
        <div class="header-right">
          <div class="header-action">
              <div class="profile">
                  <img src="assets/profile.png"/>
                  <p><?= $nama_pengguna ?></p>
              </div>
          </div>
        </div>
      </header>

      <main>
        
        <section class="table-container">
          <form action="controller/edit_sales.php" method="post">

            <div class="field-wrapper">
              <label>Nama Barang</label>
              <select id="nama_barang" name="nama_barang" method="post" class="text-field">
                <?php
                $sqlSales = "SELECT *
                FROM barang b ";
                $resultSales = $mysqli->query($sqlSales);
                while ($row = $resultSales->fetch_assoc()){
                    if($id_barang == $row["id_barang"]){
                        ?>
                        <option value = "<?php echo $row["id_barang"];?>" selected><?php echo $row["nama_barang"];?></option>
                        <?php
                    }else{
                        ?>
                        <option value = "<?php echo $row["id_barang"];?>"><?php echo $row["nama_barang"];?></option>
                        <?php 
                    }
                 
                }
                ?>
              </select>
            </div>

            <div class="field-wrapper">
              <label>Pelanggan</label>
              <select id="nama_pelanggan" name="nama_pelanggan" class="text-field">
                <?php
                $sqlSales = "SELECT *
                FROM pelanggan b ";
                $resultSales = $mysqli->query($sqlSales);
                while ($row = $resultSales->fetch_assoc()){
                  ?>
                  <option value = "<?php echo $row["id_pelanggan"];?>"><?php echo $row["nama_pelanggan"];?></option>
                  <?php

                  if($id_pelanggan == $row["id_pelanggan"]){
                      ?>
                      <option value = "<?php echo $row["id_pelanggan"];?>" selected><?php echo $row["nama_pelanggan"];?></option>
                      <?php
                  }else{
                      ?>
                  <option value = "<?php echo $row["id_pelanggan"];?>"><?php echo $row["nama_pelanggan"];?></option>
                  <?php
}
                }
                ?>
              </select>
            </div>

            <div class="field-wrapper">
              <label>Jumlah</label>
              <input id="jumlah" name="jumlah" onkeyup="myFunction()" value="<?php echo $jumlah_penjualan?>" class="text-field"/>
            </div>

            <div class="field-wrapper">
              <label>Total Harga</label>
              <input id="total" name="total" readonly value="<?php echo $harga_jual?>" class="text-field"/>
              <input type="hidden" id="id_penjualan" name="id_penjualan" value="<?php echo $id_penjualan?>" readonly/>
              <input type="hidden" id="username" name="username" value="1" readonly/>
              <input  type="hidden"  id="password" name="password" value="1" readonly/>
            </div>


            <div>
            <br>
              <button class="btn-add">Submit</button>
            </div>

          </form>
        </section>
      </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      function logout() {
        window.location.href = '?id_penjualan=1&logout=1'
      }

      function myFunction() {
        var x = document.getElementById("jumlah").value;
        var y = document.getElementById("nama_barang").value;
        var total= 0;

        $.ajax({ 
        type: 'GET', 
        url: 'harga_barang.php', 
        data:"harga="+y,
        dataType: 'json',
        success: function (data) { 
            total = data*x;
            document.getElementById("total").value = total;
          }
        });
      }
      document.getElementById('logoutButton').addEventListener('click', logoutUser);
    </script>
  </body>
</html>