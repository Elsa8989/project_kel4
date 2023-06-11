<?php
class nilai {
    public $prod,
           $mtk,
           $ing;
    
    public function __construct($prod, $mtk, $ing) {
        $this->prod = $prod;
        $this->mtk = $mtk;
        $this->ing = $ing;
    }

    public function tambah() {
        return $this->prod + $this->mtk + $this->ing;
    }

    public function rata() {
        return ($this->prod + $this->mtk + $this->ing) / 3;
    }

    public function max() {
        return max($this->prod, $this->mtk, $this->ing);
    }

    public function min() {
        return min($this->prod, $this->mtk, $this->ing);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Input Nilai</title>
</head>
<body>
    <center>
        <h2>Masukkan Nilai!</h2>
        <hr>
    <form action="" method="post">
        <label for="">Produktif</label><br>
        <input type="text" name="prod">
        <br>
        <label for="">Matematika</label><br>
        <input type="text" name="mtk">
        <br>
        <label for="">Bahasa Inggris</label><br>
        <input type="text" name="ing">
        <br>
        <button type="submit" name="submit">Submit</button>
    </form>
    <center>
    
        <?php

        include "koneksi.php";
        if(isset($_POST["submit"])){
            $prod = $_POST["prod"];
            $mtk = $_POST["mtk"];
            $ing = $_POST["ing"];

        

        $sql = "INSERT INTO input_nilai(prod,mtk,ing) 
        VALUES ('$prod','$mtk','$ing')";
        
        global $conn;
        $result = mysqli_query($conn, $sql);
        if($result){
            $sql = "SELECT * FROM input_nilai";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0) {
                while($tampil = mysqli_fetch_assoc($result)){
                    $tampil = new nilai($tampil['prod'], $tampil['mtk'], $tampil['ing']);
                    echo "Nilai Total: " . $tampil->tambah() . "<br>";
                    echo "Nilai Rata-Rata: " . $tampil->rata() . "<br>";
                    echo "Nilai Maksimum: " . $tampil->max() . "<br>";
                    echo "Nilai Minimum: " . $tampil->min() . "<br>";

        
        }
    }
}
}

        ?>
        <a href="logout.php">Keluar?</a>;
</body>
</html>