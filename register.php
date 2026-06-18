<?php
    include "service/database.php";
    session_start();

    $register_message = "";

        if(isset($_SESSION["is_login"])) {
        header("Location: dashboard.php");
    }

    if(isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        try {
            $sql = "INSERT INTO user (username, password) VALUES 
        ('$username', '$password')";

            if($db->query($sql)) {
                $register_message = "Data berhasil ditambahkan, silahkan login";
            } else {
                $register_message = "Data gagal ditambahkan";
            }
        } catch (mysqli_sql_exception $e) {
            $register_message = " Username sudah digunakan ";
        }
        $db->close();
     }    
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "layout/header.html" ?>
    <h3>DAFTAR AKUN</h3>
    <i><?= $register_message ?></i>

    <form action="register.php" method="post">
        <input type="text" placeholder="username" name="username"/>
        <input type="password" placeholder="password" name="password"/>
        <button type="submit" name="register">Daftar</button>
    </form> 
    <?php include "layout/footer.html" ?>
</body>
</html>