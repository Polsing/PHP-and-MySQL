<?php
include('../Connection/conn.php');
session_start();
if(!isset($_SESSION['true'])){
    header('location: KeyPW.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>new Password</title>
</head>
<body>
    <div class="contenner">
        <?php
        echo "<h5>".$_SESSION['Kmail']."</h5>";
        ?>
        <form action="newPW.php" method="post">
            <input type= 'password' id="password1" name="pss" placeholder='new Password' oninput="checkPasswordMatch()"required>
            <input type= 'password' id="password2" placeholder='Confirm Password' oninput="checkPasswordMatch()"required>
            <div class="show-PW">
            <span> Show Password</span>
            <input type="checkbox"  id="showPassword" onclick="togglePassword()">
            </div>
            <button name='submit' id="rsButton">Submit</button>
       </form>
       <?php
        if(isset($_POST['submit'])){
        $email = $_SESSION['Kmail'];
        $pass = mysqli_real_escape_string($conn,$_POST['pss']);
        $pass5 = md5($pass);
        $sqli = "UPDATE myprojace.useraccount
        SET  pw='$pass5'
        WHERE email='$email';";
        if(mysqli_query($conn,$sqli)){
            mysqli_close($conn);
            unset($_SESSION['true']);
            unset($_SESSION['Kmail']);
            header('location: ../Login/index.html');
        }
        else{
            echo"<p> เกิดข้อผิดผลาด </p>";
        }
    }
?>
    </div>
    <script src="script.js"></script>
</body>
</html>
