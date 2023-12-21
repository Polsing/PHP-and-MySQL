<?php
include_once('../Connection/conn.php');
session_start();
$id = $_SESSION['userID'];
if (isset($_FILES["image"])) {

    $delet = "SELECT file_name FROM images WHERE image_id = $id;";
    $delet_query = mysqli_query($conn , $delet);
    $delet_result = mysqli_fetch_assoc($delet_query);

    if(!empty($delet_result['file_name'])){
    $folder = "../uploads/";
    $file_path = $folder . $delet_result['file_name'];

    if (file_exists($file_path)) {
        unlink($file_path); // Delete the file
    }
   }

    $file_name = $_FILES["image"]["name"];
    $file_temp = $_FILES["image"]["tmp_name"];
    // อัปโหลดไฟล์ไปยังโฟลเดอร์ที่เลือก (ในที่นี้คือ "uploads")
    $upload_folder = "../uploads/";
    $upload_path = $upload_folder . $file_name;

    if (move_uploaded_file($file_temp, $upload_path)) {
       
        $sql = "UPDATE myprojace.images SET file_name = '$file_name' WHERE image_id = $id;";
        $result = $conn->query($sql);
        
        if ($result) {
           header('location: Editprofile.php');
        } else {
            $_SESSION['img-error'] = "โปรดลองอีกครั้ง";
            header('location: Editprofile.php');
        }
    } else {
        echo "Error uploading file.";
    }
}

if(isset($_POST['submit'])){

    // UPDATE myprojace.student
    // SET name='', sex='', faculty_name='', branch_name='', years='', status='', note='', user_id=0;
    //name
    if(isset($_POST['name'])){
        if(!empty($_POST['name'])){
            $value_name = $_POST['name'];
            $sqli_name = "UPDATE myprojace.student
            SET name = '$value_name' WHERE user_id = $id ";
            $name_query = mysqli_query($conn,$sqli_name);
            if($name_query)
            header('location: Editprofile.php');
            else
            $_SESSION['edit1'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
            header('location: Editprofile.php');
        }
    }

    //faculty
    if(isset($_POST['faculty'])){
        if(!empty($_POST['faculty'])){
            echo $_POST['faculty'];
            $value_faculty = $_POST['faculty'];
            $faculty_name = "UPDATE myprojace.student
            SET faculty_name = '$value_faculty' WHERE user_id = $id ";
            $faculty_query = mysqli_query($conn,$faculty_name);
            if($faculty_query)
            header('location: Editprofile.php');
            else
            $_SESSION['edit1'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
            header('location: Editprofile.php');
        }
    }

    //branch
    if(isset($_POST['branch'])){
        if(!empty($_POST['branch'])){
            echo $_POST['branch'];
            $value_branch = $_POST['branch'];
            $branch_name = "UPDATE myprojace.student
            SET branch_name = '$value_branch' WHERE user_id = $id ";
            $branch_query = mysqli_query($conn,$branch_name);
            if($branch_query)
            header('location: Editprofile.php');
            else
            $_SESSION['edit1'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
            header('location: Editprofile.php');
        }
    }

     //years
     if(isset($_POST['years'])){
        if(!empty($_POST['years'])){
            echo $_POST['years'];
            $value_years = $_POST['years'];
            $years_name = "UPDATE myprojace.student
            SET years = '$value_years' WHERE user_id = $id ";
            $years_query = mysqli_query($conn,$years_name);
            if($years_query)
            header('location: Editprofile.php');
            else
            $_SESSION['edit1'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
            header('location: Editprofile.php');
        }
    }

    //status
    if(isset($_POST['status'])){
        if(!empty($_POST['status'])){
            echo $_POST['status'];
            $value_status = $_POST['status'];
            $status_name = "UPDATE myprojace.student
            SET status = '$value_status' WHERE user_id = $id ";
            $status_query = mysqli_query($conn,$status_name);
            if($status_query)
            header('location: Editprofile.php');
            else
            $_SESSION['edit1'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
            header('location: Editprofile.php');
        }
    }

    //sex
    if(isset($_POST['sex'])){
        if(!empty($_POST['sex'])){
            echo $_POST['sex'];
            $value_sex = $_POST['sex'];
            $sex_name = "UPDATE myprojace.student
            SET sex = '$value_sex' WHERE user_id = $id ";
            $sex_query = mysqli_query($conn,$sex_name);
            if($sex_query)
            header('location: Editprofile.php');
            else
            $_SESSION['edit1'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
            header('location: Editprofile.php');
        }
    }

    //note
    if(isset($_POST['note'])){
        if(!empty($_POST['note'])){
            echo $_POST['note'];
            $value_note = $_POST['note'];
            $note_name = "UPDATE myprojace.student
            SET note = '$value_note' WHERE user_id = $id ";
            $note_query = mysqli_query($conn,$note_name);
            if($note_query){
            echo'error';
            header('location: Editprofile.php');
            }
            else
            $_SESSION['edit1'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
            header('location: Editprofile.php');
        }
    }

}

mysqli_close($conn);