<!DOCTYPE html>

<?php
  require_once "connection.php";

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
    <link rel="stylesheet" type="text/css" href="dash.css">
    <title>Dashboard</title>
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
              <li><a href="#" class="active"><span class="las la-video"></span><span>Sales</span></a></li>
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
            <h1>Sales</h1>
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
        <section class="overview">
          <h1>Good Afternoon!</h1>
          <p>You now login as <b><?= $nama_pengguna ?></b>. Your role is a <?= $access ?>.<p>
        </section>
        <section class="table-container">
          <table class="rwd-table">
            <tr>
              <th>Product Name</th>
              <th>Sales</th>
              <th>Price</th>
              <?php if ($access === 'editor'): ?>
                <th>Action</th>
              <?php endif; ?>
            </tr>
            <?php
              if ($resultSales->num_rows > 0) {
                while ($row = $resultSales->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["nama_barang"] . "</td>";
                  echo "<td>" . $row["jumlah_penjualan"] . " Pcs" . "</td>";
                  echo "<td>" . $row["harga_jual"] . "</td>";
                  if ($access === 'editor') {
                    echo "<td class=action-table>Edit Data</td>";
                  }
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