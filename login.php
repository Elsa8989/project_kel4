<?php
include 'koneksi.php';
 
error_reporting(0);
session_start();

class up {
    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function up() {
        if ($this->username === 'admin' && $this->password === 'password') {
            $_SESSION['username'] = $this->username;
            header('Location: masuk.php');
            exit();
        } else {
            echo "Username atau password salah";
        }
    }
}
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tb_input WHERE username='$username' AND password='$password' ";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];

        header("Location: masuk.php");
    } else {
        echo "<script>alert('Username atau password Anda salah. Silahkan coba lagi!')</script>";
    }

    $user = new User($username, $password);
    $user->up();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Halaman Login</title>
</head>
<body>
    <center>
        <div class="container">
    <h2>Login</h2>
    <form method="post" action="">
        <label for="username">Username</label>
        <br>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Password</label>
        <br>
        <input type="password" name="password" id="password" required><br><br>
        
        <button type="submit" value="submit">Submit</button>
        <br>
        <label>Belum punya akun?<a href="regis.php">Daftar</a></label>
    </form>
</div>
</div>
</body>
</html>