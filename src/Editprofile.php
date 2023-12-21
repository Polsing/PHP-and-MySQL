<?php
    include_once('../Connection/conn.php');
    include_once('../private/function.php');
    session_start();
    if(!isset($_SESSION['useraccount'])){
    header('location:../Login/index.php');
    //exit();
    }

    $userID = $_SESSION['userID'];
    $sqli = "SELECT * FROM student 
             FULL JOIN images
             ON user_id = image_id
             WHERE user_id = $userID;";

    $query = mysqli_query($conn , $sqli);
    $rows = mysqli_fetch_assoc($query);

    $x = faculty();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Myprofile.css">
    <link rel="stylesheet" href="../css/Editprofile.css">
    <link rel="icon" type="image" href="../images/APL.jpg">
    <title>APL | @Edit profile</title>
</head>
<body>
    <header>
    <nav class="navbar fixed-top color">
  <div class="container-fluid">
    <!-- <a class="navbar-brand" href="#">Offcanvas dark navbar</a> -->
    <?php echo"<h2>".$rows['name']."</h2>"; ?>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <!-- <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5> -->
        <div class="image">
          <?php echo' <img src="../uploads/';
                if(strlen($rows['file_name']) == 0)
                   echo'profile.jpg">';
                else 
                  echo $rows['file_name'].'">';  
               ?>
         
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" href="../Index.php">Home</a>
            <a class="nav-link" href="Myprofile.php">Profile</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Setting
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="Editprofile.php">Setting Profile</a></li>
              <li><a class="dropdown-item" href="#">Change Email</a></li>
              <li><a class="dropdown-item" href="../private/PHPMailer-main/index.php">Change Password</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
                    <?php 
                    if(isset($_SESSION['useraccount']) && isset($_SESSION['userID']))
                    echo '<li><a class="dropdown-item" href="../logout.php">Logout</a>';
                    ?>

            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
</header>

<div class="container">
  <div class="products-con">
    <div class="products-item imgs">
        <div class="image-item">
        <?php echo' <img id="displayedImage" alt="Displayed Image" src="../uploads/';
                if(strlen($rows['file_name']) == 0)
                   echo'profile.jpg">';
                else 
                  echo $rows['file_name'].'">';  
               ?>
        </div>
        <form action="updateProfile.php" method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="fileInput" accept="image/*" style="display: none;">
            <button name="submit" id="submit" style="display: none;"></button>
        </form>

        <ion-icon class="ion icon1" name="image-outline" id="Editimg" onclick="chooseImage1()"></ion-icon>
        <ion-icon class="ion icon2" name="cloud-download-outline" id="CheckIcon_1" onclick="submit_1()" style="display: none;"></ion-icon>
        <?php 
          if(isset($_SESSION['img-error'])){
              echo '<p class="img-error">'.$_SESSION['img-error'].'</p>';
              unset($_SESSION['img-error']);
          }
        ?>
        </div>
    <div class="products-item name">
      <form action="updateProfile.php" method="post">
      <?php 
        if(strlen($rows['name']) <= 0)
            $nameEdit =  "Name";
        else
            $nameEdit =  $rows['name'];
        ?>
        <input id="names" name="name" class="edit name-edit" type="text" placeholder="<?php echo $nameEdit;?>" oninput="toggleButton('names','submit-name')">
      <br>
      <div class="faculty">
        <?php 
        if(strlen($rows['faculty_name']) <= 0)
            $facultyEdit =  "โปรดเลือกคณะ";
        else
            $facultyEdit =  $rows['faculty_name'];
        ?>
      <h4>คณะ</h4>
      <select name="faculty" class="edit edit-faculty" id="faculty" onchange="updateBranchOptions()" oninput="toggleButton('faculty','submit-name')">
                    <option disabled selected><?php echo $facultyEdit;?></option>
                    <?php foreach($x as $a): ?>
                            <option value="<?php echo $a["ชื่อคณะ"];?>" > <?php 
                            echo $a["ชื่อคณะ"];?>
                            </option>
                    <?php endforeach; ?>
     </select>
     </div>
     <div class="branch">
        <?php 
        if(strlen($rows['branch_name']) <= 0)
            $branchEdit =  "โปรดเลือกคณะก่อน";
        else
            $branchEdit =  $rows['branch_name'];
        ?>
        <h4>สาขา</h4>
        <select name="branch" id="branch" class="edit edit-branch" oninput="toggleButton('branch','submit-name')">
                    <option disabled selected><?php echo $branchEdit;?></option>
        </select>
      </div>
      
       <div class="years">
        <?php 
        if(strlen($rows['years']) <= 0)
            $yearsEdit =  "ปี";
        else
            $yearsEdit =  $rows['years'];
        ?>
        <select name="years" id="years" class="edit years" oninput="toggleButton('years','submit-name')">
                    <option disabled selected><?php echo $yearsEdit;?></option>
                    <option value="ปี 1">ปี 1</option>
                    <option value="ปี 2">ปี 2</option>
                    <option value="ปี 3">ปี 3</option>
                    <option value="ปี 4">ปี 4</option>
        </select>
      </div>

      <div class="status">
        <?php 
        if(strlen($rows['status']) <= 1)
            $statusEdit =  "status";
        else
            $statusEdit =  $rows['status'];
        ?>
        <select name="status" id="status" class="edit status" oninput="toggleButton('status','submit-name')">
                    <option disabled selected><?php echo $statusEdit;?></option>
                    <option value="โสด">โสด</option>
                    <option value="มีเเฟนเเล้ว">มีเเฟนเเล้ว</option>
                    <option value="คนคุย">คนคุย</option>
                    <option value="พี่น้อง">พี่น้อง</option>
                    <option value="เพื่อน">เพื่อน</option>
                    <option value="1">ไม่ขอบอก</option>
        </select>
      </div>

      <div class="sex">
        <?php 
        if(strlen($rows['sex']) <= 1)
            $sexEdit =  "เพศ";
        else
            $sexEdit =  $rows['sex'];
        ?>
        <select name="sex" id="sex" class="edit sex" oninput="toggleButton('sex','submit-name')">
                    <option disabled selected><?php echo $sexEdit;?></option>
                    <option value="ชาย">ชาย</option>
                    <option value="หญิง">หญิง</option>
                    <option value="LGBTQ">LGBTQ</option>
                    <option value="1">ไม่ขอบอก</option>
        </select>
      </div>
      <button name="submit" class="smt-name" style="display: none" id="submit-name">Submit</button>
      </form>
      <?php if(isset($_SESSION['edit1'])) {
              echo "<p>".$_SESSION['edit1']."</p>";
               unset($_SESSION['edit1']);
         }?>
      <p class="uni">SRIPATUM UNIVERSITY</p>
    </div>
    <div class="products-item follow-me">
      <h4>FOLLOW ME</h4>
      <?php 
      if(isset($_SESSION['edit_follow'])) {
         echo "<p>".$_SESSION['edit_follow']."</p>";
         unset($_SESSION['edit_follow']);
      }

      $follow = "SELECT facebook, instagram, youtube, twitter, tiktok, github 
                 FROM myprojace.follow
                 WHERE follow_id = $userID";

                 $result = mysqli_query($conn,$follow);
                 $fll = mysqli_fetch_assoc($result);
      ?>
        <form action="updatefollow.php" method="post">
      <div class="me faecbook">
      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
      <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
      </svg>
      <?php 
        if(strlen($fll['facebook'] <= 0))
        $facebook = "facebook";
        else
        $facebook = $fll['facebook'];
      ?>
        <input type="text" placeholder="<?php echo $facebook; ?>" name="facebook" class="inputFollow" id="follow1" oninput="toggleButton('follow1','submitfollow')">
        <input type="text" placeholder="URL" name="facebookURL" class="inputFollow" id="follow2" oninput="toggleButton('follow2','submitfollow')">
      </div>

      <div class="me instagram">
      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#E4405F" class="bi bi-instagram" viewBox="0 0 16 16">
      <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
      </svg>
      <?php 
        if(strlen($fll['instagram'] <= 0))
        $instagram = "instagram";
        else
        $instagram = $fll['instagram'];
      ?>
        <input type="text" placeholder="<?php echo $instagram; ?>" name="instagram" class="inputFollow" id="follow3" oninput="toggleButton('follow3','submitfollow')">
        <input type="text" placeholder="URL" name="instagramURL" class="inputFollow" id="follow4" oninput="toggleButton('follow4','submitfollow')">
      </div>

      <div class="me youtube">
      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
      <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408z"/>
      </svg>
      <?php 
        if(strlen($fll['youtube'] <= 0))
        $youtube = "youtube";
        else
        $youtube = $fll['youtube'];
      ?>
        <input type="text" placeholder="<?php echo $youtube; ?>" name="youtube" class="inputFollow" id="follow5" oninput="toggleButton('follow5','submitfollow')">
        <input type="text" placeholder="URL" name="youtubeURL" class="inputFollow" id="follow6" oninput="toggleButton('follow6','submitfollow')">
      </div>

      <div class="me twitter">
      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
      <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15"/>
      </svg>
      <?php 
        if(strlen($fll['twitter'] <= 0))
        $twitter = "twitter";
        else
        $twitter = $fll['twitter'];
      ?>
        <input type="text" placeholder="<?php echo $twitter; ?>" name="twitter" class="inputFollow" id="follow7" oninput="toggleButton('follow7','submitfollow')">
        <input type="text" placeholder="URL" name="twitterURL" class="inputFollow" id="follow8" oninput="toggleButton('follow8','submitfollow')">
      </div>

      <div class="me tiktok">
      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#000000" class="bi bi-tiktok" viewBox="0 0 16 16">
      <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
      </svg>
      <?php 
        if(strlen($fll['tiktok'] <= 0))
        $tiktok = "tiktok";
        else
        $tiktok = $fll['tiktok'];
      ?>
        <input type="text" placeholder="<?php echo $tiktok; ?>" name="tiktok" class="inputFollow" id="follow9" oninput="toggleButton('follow9','submitfollow')">
        <input type="text" placeholder="URL" name="tiktokURL" class="inputFollow" id="follow10" oninput="toggleButton('follow10','submitfollow')">
      </div>

      <div class="me github">
      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
      <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
      </svg>
      <?php 
        if(strlen($fll['github'] <= 0))
        $github = "github";
        else
        $github = $fll['github'];
      ?>
        <input type="text" placeholder="<?php echo $github; ?>" name="github" class="inputFollow"  id="follow11" oninput="toggleButton('follow11','submitfollow')">
        <input type="text" placeholder="URL" name="githubURL" class="inputFollow"  id="follow12" oninput="toggleButton('follow12','submitfollow')">
      </div>
      <button name="submitfollow" class="smt-name follow" id="submitfollow" style="display: none;">Submit</button>
      </form>
    </div>

    <div class="products-item note">
      <h4>NOTE</h4>
      <?php 
        if(strlen($rows['note']) <= 0)
            $noteEdit =  "คิดอะไรอยู่...";
        else
            $noteEdit =  $rows['note'];
        ?>
      <br>
      <form action="updateProfile.php" method="post">
          <textarea class="editNote" name="note" placeholder="<?php echo $noteEdit;?>" id="noteInput" oninput="toggleButton('noteInput','submitButton')"></textarea>
          <button name="submit" id="submitButton" style="display: none" class="smt-name">submit</button>
      </form>
      
    </div>
  </div>
</div>
    
</body>
<script src="../js/Editprofile.js"></script>
<script src="../js/dashboard_branch.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
<?php mysqli_close($conn); ?>