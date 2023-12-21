<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    function generateRandomKey() {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
      $randomKey = substr(str_shuffle($characters), 0, 6);
      return $randomKey;
    }
 if(isset($_POST['submit'])){
    include('../../Connection/conn.php');
    $name = "APL";
    $header = "Forget Your Password";
    $_SESSION['randomKey'] = generateRandomKey();
    $detail = "ถ้าคุณได้รับอีเมล์นี้ นั่นหมายถึงว่าคุณขอกู้คืนรหัสผ่านสำหรับบัญชีของคุณที่เชื่อมโยงกับทีมของเรา\n\r".
               "กรุณาใช้ Token นี้เพื่อกำหนดรหัสผ่านใหม่ของคุณ: ".
               $_SESSION['randomKey']."\n\r".
    " หากคุณไม่ได้ทำการร้องขอการเปลี่ยนรหัสผ่านหรือมีคำถามใด ๆ กรุณาติดต่อทีมสนับสนุนของเราที่ apl.ps1199@gmail.com";
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $_SESSION['Kmail'] = $email;
    $chack_account = "SELECT COUNT(email) as count_rows
      FROM myprojace.useraccount WHERE email = '$email';";
      $query = mysqli_query($conn , $chack_account);
      $rows = mysqli_fetch_assoc($query);
         if($rows['count_rows'] <= 0){
            mysqli_close($conn);
            $_SESSION['Notemail'] = 'error';
            header('location: index.php');
            exit();
         }
         else{
            require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";
            $mail = new PHPMailer();

            // SMTP Settings
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "apl.ps1199@gmail.com"; // enter your email address
            $mail->Password = "pdvbxyffvnwfdjua"; // enter your password
            $mail->Port = 465;
            $mail->SMTPSecure = "ssl";

             //Email Settings
            $mail->isHTML(true);
            $mail->setFrom($email, $name);
            $mail->addAddress($email); // Send to mail
            $mail->Subject = $header;
            $mail->Body = $detail;

            if($mail->send()) {
                mysqli_close($conn);
                header('location: ../KeyPW.php');
                
            } else {
                mysqli_close($conn);
                $_SESSION['status'] = "failed";
                $_SESSION['response'] = "Something is wrong" . $mail->ErrorInfo;
                header('location: index.php');
            }
    
            //exit(json_encode(array("status" => $status, "response" => $response)));
         }
 }