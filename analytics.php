<!DOCTYPE html>

<?php
  require_once "models/connect.php";
  require_once "models/auth.php";
  require_once "models/sales_manager.php";

  if (isset($_SESSION['valid_token'])) {

    $salesManager = new SalesManager();
    $sales = $salesManager->getProfitSales();

    if (isset($_SESSION['nama_pengguna'])) {
      $nama_pengguna = $_SESSION['nama_pengguna'];
    }
    
    if (isset($_SESSION['access'])) {
      $access = strtolower($_SESSION['access']);
    }

    if(isset($_GET['id_penjualan'])) {
      $id_penjualan = $_GET['id_penjualan'];
      $delete = $salesManager->deleteSales($id_penjualan);
      
      if($delete) {
        header("Location: dashboard.php");
      }
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
    <title>Analytics</title>
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
              <li><a href="analytics.php" class="active"><span class="las la-calendar"></span><span>Analytics</span></a></li>
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
            <h1>Analytics</h1>
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
        <!-- <section class="overview">
          <h1>Good Afternoon!</h1>
          <p>You now login as <b><?= $nama_pengguna ?></b>. Your role is a <?= $access ?>.<p>
        </section> -->
        <section class="table-container">
          <!-- <a class="btn-container" href="add_sales.php"><Button class="btn-add">Add New Sales</Button></a> -->
          <table class="rwd-table">
            <tr>
              <th>Product Name</th>
              <th>Sales Price</th>
              <th>Purchase Price</th>
              <th>Profit</th>
              <th>Status</th>
            </tr>
            <?php
              if (!empty($sales)) {
                foreach ($sales as $sale) {
                    
                  echo "<tr>";
                  echo "<td>" . $sale["nama_barang"] . "</td>";
                  echo "<td>" . $sale["harga_jual"] . "</td>";
                  echo "<td>" . $sale["harga_beli"] . "</td>";
                  echo "<td>" . $sale["keuntungan"] . "</td>";
                  echo "<td>" . $sale["status"] . "</td>";
                  echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='" . ($access === 'editor' ? 4 : 3) . "'>No records found.</td></tr>";
                }
            ?>
          </table>
        </section>
      </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      function logout() {
        window.location.href = '?logout=1'
      }
    </script>
  </body>
</html>