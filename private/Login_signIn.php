<?php
    include('../Connection/conn.php');
    session_start();

    if(isset($_POST['signIn'])){
        $email = mysqli_real_escape_string($conn,$_POST['emai_signIn']);
        $pass = mysqli_real_escape_string($conn,$_POST['pass_signIn']);

        $pass5 = md5($pass);

        $sql = "SELECT ID,
                COUNT(email) AS count_rowsEmail,
                COUNT(pw) AS count_rowsPW
                FROM myprojace.useraccount 
                WHERE email = '$email' AND pw = '$pass5'
                GROUP BY ID;";

                $query = mysqli_query($conn , $sql );
                $rows = mysqli_fetch_assoc($query);
                if($rows['count_rowsEmail'] == 1 && $rows['count_rowsPW'] == 1){
                    mysqli_close($conn);
                    $_SESSION['useraccount'] = $email;
                    $_SESSION['userID'] = $rows['ID'];
                    header('location:../src/Editprofile.php');
        
                }
                if($rows['count_rowsEmail'] == 0 || $rows['count_rowsPW'] == 0){
                    mysqli_close($conn);
                    $_SESSION['error'] = "อีเมล์หรือระหัสผ่านไม่ถูกต้อง";
                    header('location:../Login/index.php');
                }
    }