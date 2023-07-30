<?php
  session_start();

  $hostname = "localhost";        
  $database = "db_tk4_bran";    
  $username = "root";    
  $password = "";   

  $mysqli = new mysqli($hostname, $username, $password, $database);

  if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username_input = $_POST["username"];
    $password_input = $_POST["password"];
  
    $sql = "SELECT id_pengguna, nama_pengguna, pass, nama_akses 
            FROM pengguna p 
            JOIN hakakses h ON p.id_akses = h.id_akses 
            WHERE LOWER(nama_pengguna) = ? LIMIT 1";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username_input);
    $stmt->execute();
    $result = $stmt->get_result();
    $error_message = "";

    if ($result->num_rows === 1) {
      $row = $result->fetch_assoc();
      $id_pengguna = $row["id_pengguna"];
      $nama_pengguna = $row["nama_pengguna"];
      $hashed_password = $row["pass"];
      $nama_akses = $row["nama_akses"];
      
      if (password_verify($password_input, $hashed_password) || $password_input === $hashed_password) {
        $_SESSION["valid_token"] = $id_pengguna;
        $_SESSION["access"] = $nama_akses;
        $_SESSION["nama_pengguna"] = $nama_pengguna;

        header("Location: dashboard.php");
        exit();
      } else {
        $error_message = "Invalid username or password. Please try again.";
      }
    } else {
      $error_message = "Invalid username or password. Please try again.";
    }
    
    $stmt->close();
  }
?>
