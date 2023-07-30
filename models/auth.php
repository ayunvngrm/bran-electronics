<?php
require_once "connect.php";
session_start();

    class Login {
        private $database;

        public function __construct() {
            $this->database = new Database();
        }

        public function authenticate($username_input, $password_input) {
            $sql = "SELECT id_pengguna, nama_pengguna, pass, nama_akses 
                    FROM pengguna p 
                    JOIN hakakses h ON p.id_akses = h.id_akses 
                    WHERE LOWER(nama_pengguna) = ? LIMIT 1";

            $conn = $this->database->getConnection();

            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die("Error: " . $conn->error);
            }

            $stmt->bind_param("s", $username_input);

            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $id_pengguna = $row["id_pengguna"];
                $nama_pengguna = $row["nama_pengguna"];
                $hashed_password = $row["pass"];
                $nama_akses = $row["nama_akses"];
                if (password_verify($password_input, $hashed_password) || $password_input === $hashed_password) {
                    $_SESSION['valid_token'] = $id_pengguna;
                    $_SESSION['access'] = $nama_akses;
                    $_SESSION['nama_pengguna'] = $nama_pengguna;

                    return true;
                } else {
                  return false;
                }
            } else {
              return false;
            }
        }
    }
?>
