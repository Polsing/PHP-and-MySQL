

<?php 

function students($id_user){
    global $conn;
    $id = $id_user;
    $sqli = "SELECT * FROM student WHERE user_id = $id";
    $result = mysqli_query($conn,$sqli);
    $students = mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_close($conn);
    return $students;
}

function faculty(){
    global $conn;
    $sqli = "SELECT * FROM คณะ ORDER BY ชื่อคณะ ASC";
    $result = mysqli_query($conn, $sqli);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //mysqli_close($conn);
    return $rows;
}

function imagesCover($id_user){
    global $pdo;
    $img = $id_user;
    $sql = "SELECT * FROM cover_photo WHERE user_id = $img";
    $stmts = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); 
        foreach ($stmts as $stmt) {
        $imageName = $stmt['image_name'];
        $imageData = $stmt['image_data'];
        }
        if(isset($imageName) && isset($imageData)){
         $my_image_user = "<img src='data:image/png;base64,". base64_encode(stream_get_contents($imageData)) . "' alt='$imageName'"."id='uploaded-image_1'>"; 
        }
        else{$my_image_user = "<img src='../Image/image-add-regular-24.png' alt='Image description' id='uploaded-image_1'>";} 

        pg_close($pdo);
    return $my_image_user;
}

function imagesUser($id_user){
    global $pdo;
    $img = $id_user;
    $sql = "SELECT * FROM user_photo WHERE user_id = $img";
    $stmts = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);  
    foreach ($stmts as $stmt) {
        $imageName = $stmt['image_name'];
        $imageData = $stmt['image_data'];
        }
    if(isset($imageName) && isset($imageData)){
        $my_image_user = "<img src='data:image/png;base64,". base64_encode(stream_get_contents($imageData)) . "' alt='$imageName'"."id='uploaded-image_2'>"; 
    }
    else{$my_image_user = "<img src='../Image/user.webp' alt='Image description' id='uploaded-image_2'>";} 
    pg_close($pdo);
    return $my_image_user;
}

function Contacts($id_user){
    global $conn;
    $ContactID = $id_user;
    $sqli = "SELECT * FROM contact WHERE ID = $ContactID";
    $result = mysqli_query($conn, $sqli);
    $contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $contacts;
}