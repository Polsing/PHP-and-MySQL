<?php
 include('Connection/conn.php');
 include('private/function.php');
$x = faculty();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="icon" type="image/jpg" href="images/APL.jpg">
    <title>APL PS | @SPU</title>
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="logo">
                <img src="images/SPU logo.webp" ">
            </div>
            <!-- <a class="navbar-brand" href="#">SPU</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 250px;">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="src/Myprofile.php">Profile</a>
                </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Contact
                </a>
            <ul class="dropdown-menu">
                <form method="get">
                <li><select name="faculty" id="faculty" onchange="updateBranchOptions()">
                    <option disabled selected>คณะ:</option>
                    <?php foreach($x as $a): ?>
                            <option value="<?php echo $a["ชื่อคณะ"];?>" > <?php 
                            echo $a["ชื่อคณะ"];?>
                            </option>
                    <?php endforeach; ?>
                </select></li>
                <li><select name="branch" id="branch">
                    <option disabled selected>กรุณาเลือกคณะก่อน</option>
                </select></li>
                <li><select name="years">
                    <option disabled selected>ชั้นปี:</option>
                    <option value="ปี 1">ปี 1</option>
                    <option value="ปี 2">ปี 2</option>
                    <option value="ปี 3">ปี 3</option>
                    <option value="ปี 4">ปี 4</option>
                </select></li>
                <li><select name="sex">
                    <option disabled selected>เพศ:</option>
                    <option value="ชาย">ชาย</option>
                    <option value="หญิง">หญิง</option>
                    <option value="LGBTQ">LGBTQ</option>
                </select></li>
                <li><select name="status">
                    <option disabled selected>สถานะ:</option>
                    <option value="โสด">โสด</option>
                    <option value="มีเเฟนเเล้ว">มีเเฟนเเล้ว</option>
                    <option value="คนคุย">คนคุย</option>
                    <option value="พี่น้อง">พี่น้อง</option>
                    <option value="เพื่อน">เพื่อน</option>
                </select></li>
                <li><hr class="dropdown-divider"></li>
                <div class="submit">
                    <button name="submit">select</button>
                </div>
                </form>
            </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Setting
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Change Email</a></li>
                    <li><a class="dropdown-item" href="private/PHPMailer-main/index.php">Change Password</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <?php 
                    if(isset($_SESSION['useraccount']) && isset($_SESSION['userID']))
                    echo '<li><a class="dropdown-item" href="logout.php">Logout</a>';

                    else
                    echo '<li><a class="dropdown-item" href="Login/index.php">SignIn</a>';
                    ?>

                </ul>
        </li>
        
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    </header>
    <div class="container">
        <?php
        if (isset($_GET['submit'])) {
            $condition = " "; 
            if (!empty($_GET['faculty'])) 
            $condition .= " คณะ <b>".$_GET['faculty']."</b>";
            if (!empty($_GET['branch'])) 
            $condition .= " สาขา <b>".$_GET['branch']."</b>";
            if (!empty($_GET['years']))
            $condition .= " <b>" . $_GET['years']."</b>";
            if (!empty($_GET['status']))
            $condition .= " status <b>" .$_GET['status']."</b>";
            echo"<p>".$condition."</p>";
        }
        ?>
        <b></b>
        <div class="products-con">
            <?php
                $sqli = "SELECT name , user_id , file_name FROM student
                         LEFT JOIN images on images.image_id = student.user_id";
                    if (isset($_GET['submit'])) {
                        $conditions = []; // เก็บเงื่อนไขที่ต้องการเพิ่มใน SQL query
                        if (!empty($_GET['faculty'])) 
                            $conditions[] = "faculty_name = '" . $_GET['faculty'] . "'";
                        if (!empty($_GET['branch'])) 
                            $conditions[] = "branch_name = '" . $_GET['branch'] . "'";
                        if (!empty($_GET['years']))
                            $conditions[] = "years = '" . $_GET['years'] . "'";
                        if (!empty($_GET['sex'])) 
                            $conditions[] = "sex = '" . $_GET['sex'] . "'";
                        if (!empty($_GET['status']))
                            $conditions[] = "status = '" . $_GET['status'] . "'";
                        // ตรวจสอบว่ามีเงื่อนไขใหม่ใน $conditions หรือไม่
                        if (!empty($conditions))
                            $sqli .= " WHERE " . implode(" AND ", $conditions);
                    }



                $sqli_query = mysqli_query($conn, $sqli);        
                $rows = mysqli_fetch_all( $sqli_query,MYSQLI_ASSOC);
                foreach($rows as $row){
                echo '<div class="products-item" onclick="clickIcon(\'button' . $row['user_id'] . '\')">
                <div class="img-item">
                <img src="uploads/';if(strlen($row['file_name']) == 0)
                                   echo'profile.jpg';
                                   else 
                                   echo $row['file_name'];  
                echo'">
                </div>
                <div class="title">
                <p>'.$row['name'].'</p>
                </div>
                <form action="profile.php" method="post">
                    <button id="button' . $row['user_id'] . '" value="' . $row['user_id'] . '" name="select" style="display: none;"></button>
                </form>
                </div>';
                }    
            ?>

        </div>
    </div>
</body>
<script src="js/dashboard_branch.js"></script>
<script src="js/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>
<?php 
mysqli_close($conn);
?>