<?php
include('../Connection/conn.php');
session_start();
   if(isset($_POST['SignUp'])){
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $pass = mysqli_real_escape_string($conn,$_POST['pass']);
     

      $chack_account = "SELECT COUNT(email) as count_rows
      FROM myprojace.useraccount WHERE email = '$email';";
      $query = mysqli_query($conn , $chack_account);
      $rows = mysqli_fetch_assoc($query);
         if($rows['count_rows'] >= 1){
            mysqli_close($conn);
            $_SESSION['error'] = "มี 'email' นี้อยู่เเล้ว";
            header('location:../Login/index.php');
         }
         else{
           $pass5 = md5($pass);
           $CreateAc = "INSERT INTO myprojace.useraccount(email, pw) VALUES('$email','$pass5');";
           mysqli_query($conn,$CreateAc);

           $sqli = "SELECT ID FROM myprojace.useraccount WHERE email = '$email';";
           $query_id = mysqli_query($conn , $sqli);
           $rows = mysqli_fetch_assoc($query_id);
           $user_id = $rows['ID'];

           $student = "INSERT INTO myprojace.student (user_id) VALUES ($user_id);";
           mysqli_query($conn,$student);

           $images = "INSERT INTO myprojace.images (image_id) VALUES ($user_id);";
           mysqli_query($conn,$images);

           $follow = "INSERT INTO myprojace.follow (follow_id) VALUES ($user_id);";
           mysqli_query($conn,$follow);
           

           mysqli_close($conn);
           header('location:../src/Editprofile.php');
         }
   }
   
