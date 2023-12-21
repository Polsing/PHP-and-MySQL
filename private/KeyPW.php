<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Reset Password</title>
</head>
<body>
    <div class="contenner">
        <?php
        echo"
           <h5>เราได้ส่ง Token 6 หลัก ไปยัง 📧 ".$_SESSION['Kmail']." เเล้ว
           <br>
           โปรจตรวจสอบในกล่องจดหมาย 📥 หรือ จดหมายขยะ 🗑️ </h5>";
           ?>
        
       <form action="KeyPW.php" method="post">
            <input type= 'text' name='Token' placeholder='Token 6 หลัก'>
            <button name='submit'>Submit</button>
       </form>
       <a href="PHPMAIler-main/index.php">ส่งอีเมล์ใหม่อีกครั้ง</a>

       <?php
            if(isset($_POST['submit'])){
                $token  = $_POST['Token'];
                $tokenUser = $_SESSION['randomKey'];
                if($token === $tokenUser){
                    
                    $_SESSION['true'] = "true";
                    header('location: newPW.php');
                }
                else{
                    echo"<p>Token ไม่ถูกต้อง </p> ";
                }
            }
       ?>
    </div>
</body>
</html>
