<?php
include 'koneksi.php';

error_reporting(0);
session_start();

class up {
    private $username;
    private $password;
    private $cpassword;

    public function __construct($username, $password, $cpassword) {
        $this->username = $username;
        $this->password = $password;
        $this->cpassword = $cpassword;
    }

    public function up() {
        global $conn; 

        if ($this->password == $this->cpassword) {
            $sql = "SELECT * FROM tb_input WHERE username='$this->username'";
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0) {
                $sql = "INSERT INTO tb_input (username, password)
                        VALUES ('$this->username', '$this->password')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "
                        <script>alert('Selamat, pendaftaran berhasil!');
                        document.location.href = 'login.php';
                        </script>";
                    $this->username = "";
                    $_POST['password'] = "";
                    $_POST['cpassword'] = "";
                } else {
                    echo "<script>alert('Terjadi kesalahan.')</script>";
                }
            } else {
                echo "<script>alert('Username Sudah Terdaftar.')</script>";
            }
        } else {
            echo "<script>alert('Password Tidak Sesuai')</script>";
        }
    }
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $user = new up($username, $password, $cpassword);
    $user->up();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Halaman Registrasi</title>
</head>
<body>
    
    <center>
    <div class="container">
    <h2>Daftar</h2>
    <form method="post" action="">
        <label for="username">Username</label>
        <br>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Password</label>
        <br>
        <input type="password" name="password" id="password" required><br><br>
        <label for="cpassword">Konfirmasi Password</label>
        <br>
        <input type="password" name="cpassword" id="cpassword" required><br><br>
        <button type="submit" name="submit" value="submit">Submit</button>
    </form>
    </center>
</body>
</html>

