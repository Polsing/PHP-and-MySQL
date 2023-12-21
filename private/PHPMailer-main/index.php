<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Forget Your Password</title>
</head>
<body>
    <div class="fgp">
        <h1>Forget Your Password</h1>
        <?php 
        if(isset($_SESSION['Notemail']))
        echo"<p>ไม่พบอีเมล์ 🙀 โปรดตรวจสอบข้อมูลให้ถูกต้อง</p>
             <p>หรือถ้ายังไม่มีบัญชี โปรดทำการ SignUp 👇🏻</p>";
        unset($_SESSION['Notemail']);
        ?>
        <form action="sendMail.php" method="post">
        <input type="text" name="email" placeholder="Email">
        <button name="submit">Submit</button>
        </form>
        <?php
            if(isset($_SESSION['status']) || isset($_SESSION['response']))
            echo"<p>".$_SESSION['status'].$_SESSION['response']."</p>";
            unset($_SESSION['status']);
            unset($_SESSION['response']);
        ?>
        <a href="../../Login/index.html">Login? & SignUp?</a>
    </div>
</body>
</html>