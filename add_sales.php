<!DOCTYPE html>

<?php
  require_once "connection.php";


  if (isset($_SESSION['valid_token'])) {
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
    <!-- <link rel="stylesheet" type="text/css" href="styles/form.css"> -->
    <title>Add Sales</title>
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
            <h1>Add Sales</h1>
            <h>
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
          <form action="controller/add_sales.php" method="post">
            <div class="field-wrapper">
              <label>Nama Barang</label>
              <!-- <br> -->
              <select id="nama_barang" name="nama_barang" method="post" class="text-field">
                <?php
                $sqlSales = "SELECT *
                FROM barang b ";
                $resultSales = $mysqli->query($sqlSales);
                while ($row = $resultSales->fetch_assoc()){
                  ?>
                  <option value = "<?php echo $row["id_barang"];?>"><?php echo $row["nama_barang"];?></option>
                  <?php
                }
                ?>
              </select>
            </div>

            <div class="field-wrapper">
            <label>Pelanggan</label>
              <!-- <br> -->
              <select id="nama_pelanggan" name="nama_pelanggan" class="text-field">
                <?php
                $sqlSales = "SELECT *
                FROM pelanggan b ";
                $resultSales = $mysqli->query($sqlSales);
                while ($row = $resultSales->fetch_assoc()){
                  ?>
                  <option value = "<?php echo $row["id_pelanggan"];?>"><?php echo $row["nama_pelanggan"];?></option>
                  <?php
                }
                ?>
              </select>
            </div>

            <div class="field-wrapper">
              <label>Jumlah</label>
              <input id="jumlah" name="jumlah" onkeyup="myFunction()" class="text-field"/>
            </div>

            <div class="field-wrapper">
              <label>Total Harga</label>
              <input id="total" name="total" readonly class="text-field"/>
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
        window.location.href = '?logout=1'
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
            //console.log(data);
            total = data*x;
            document.getElementById("total").value = total;
          }
        });
      }
      document.getElementById('logoutButton').addEventListener('click', logoutUser);
    </script>
  </body>
</html>