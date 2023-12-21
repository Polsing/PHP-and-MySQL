<?php 
include_once('../Connection/conn.php');

session_start();
if(!isset($_SESSION['useraccount'])){
    header('location:../index.php');
    exit();
    }
$foiiow_id = $_SESSION['userID'];

if(isset($_POST['submitfollow'])){
    //UPDATE myprojace.follow SET facebook='', instagram='', youtube='', twitter='', tiktok='', github='', facebookURL='', instagramURL='', youtubeURL='', twitterURL='', tiktokURL='', githubURL='', follow_id=0;

        //facebook
        if(!empty($_POST['facebook'])){
            $facebook = mysqli_real_escape_string($conn,$_POST['facebook']);
            $sqli_facebook = "UPDATE myprojace.follow SET facebook = '$facebook' WHERE follow_id = $foiiow_id";
            $facebook_result =  mysqli_query($conn,$sqli_facebook);
            if($facebook_result){
                header('location:Editprofile.php');
            }
            else{
                $_SESSION['edit_follow'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
                header('location:Editprofile.php');
            }
        }
        //facebookURL
        if(!empty($_POST['facebookURL'])){
            $facebookURL = mysqli_real_escape_string($conn,$_POST['facebookURL']);
            $sqli_facebookURL = "UPDATE myprojace.follow SET facebookURL = '$facebookURL' WHERE follow_id = $foiiow_id";
            $facebookURL_result =  mysqli_query($conn,$sqli_facebookURL);
            if($facebookURL_result){
                header('location:Editprofile.php');
            }
            else{
                $_SESSION['edit_follow'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
                header('location:Editprofile.php');
            }
        }

        //instagram
        if(!empty($_POST['instagram'])){
            $instagram = mysqli_real_escape_string($conn,$_POST['instagram']);
            $sqli_instagram = "UPDATE myprojace.follow SET instagram = '$instagram' WHERE follow_id = $foiiow_id";
            $instagram_result =  mysqli_query($conn,$sqli_instagram);
            if($instagram_result){
                header('location:Editprofile.php');
            }
            else{
                $_SESSION['edit_follow'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
                header('location:Editprofile.php');
            }
        }
        //instagramURL
        if(!empty($_POST['instagramURL'])){
            $instagramURL = mysqli_real_escape_string($conn,$_POST['instagramURL']);
            $sqli_instagramURL = "UPDATE myprojace.follow SET instagramURL = '$instagramURL' WHERE follow_id = $foiiow_id";
            $instagramURL_result =  mysqli_query($conn,$sqli_instagramURL);
            if($instagramURL_result){
                header('location:Editprofile.php');
            }
            else{
                $_SESSION['edit_follow'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
                header('location:Editprofile.php');
            }
        }

        //youtube
        if(!empty($_POST['youtube'])){
            $youtube = mysqli_real_escape_string($conn,$_POST['youtube']);
            $sqli_youtube = "UPDATE myprojace.follow SET youtube = '$youtube' WHERE follow_id = $foiiow_id";
            $youtube_result =  mysqli_query($conn,$sqli_youtube);
            if($youtube_result){
                header('location:Editprofile.php');
            }
            else{
                $_SESSION['edit_follow'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
                header('location:Editprofile.php');
            }
        }
        //youtubeURL
        if(!empty($_POST['youtubeURL'])){
            $youtubeURL = mysqli_real_escape_string($conn,$_POST['youtubeURL']);
            $sqli_youtubeURL = "UPDATE myprojace.follow SET youtubeURL = '$youtubeURL' WHERE follow_id = $foiiow_id";
            $youtubeURL_result =  mysqli_query($conn,$sqli_youtubeURL);
            if($youtubeURL_result){
                header('location:Editprofile.php');
            }
            else{
                $_SESSION['edit_follow'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
                header('location:Editprofile.php');
            }
        }

        //twitter
        if(!empty($_POST['twitter'])){
            $twitter = mysqli_real_escape_string($conn,$_POST['twitter']);
            $sqli_twitter = "UPDATE myprojace.follow SET twitter = '$twitter' WHERE follow_id = $foiiow_id";
            $twitter_result =  mysqli_query($conn,$sqli_twitter);
            if($twitter_result){
                header('location:Editprofile.php');
            }
            else{
                $_SESSION['edit_follow'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
                header('location:Editprofile.php');
            }
        }
        //twitterURL
        if(!empty($_POST['twitterURL'])){
            $twitterURL = mysqli_real_escape_string($conn,$_POST['twitterURL']);
            $sqli_twitterURL = "UPDATE myprojace.follow SET twitterURL = '$twitterURL' WHERE follow_id = $foiiow_id";
            $twitterURL_result =  mysqli_query($conn,$sqli_twitterURL);
            if($twitterURL_result){
                header('location:Editprofile.php');
            }
            else{
                $_SESSION['edit_follow'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
                header('location:Editprofile.php');
            }
        }

        //tiktok
        if(!empty($_POST['tiktok'])){
            $tiktok = mysqli_real_escape_string($conn,$_POST['tiktok']);
            $sqli_tiktok = "UPDATE myprojace.follow SET tiktok = '$tiktok' WHERE follow_id = $foiiow_id";
            $tiktok_result =  mysqli_query($conn,$sqli_tiktok);
            if($tiktok_result){
                header('location:Editprofile.php');
            }
            else{
                $_SESSION['edit_follow'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
                header('location:Editprofile.php');
            }
        }
        //tiktokURL
        if(!empty($_POST['tiktokURL'])){
            $tiktokURL = mysqli_real_escape_string($conn,$_POST['tiktokURL']);
            $sqli_tiktokURL = "UPDATE myprojace.follow SET tiktokURL = '$tiktokURL' WHERE follow_id = $foiiow_id";
            $tiktokURL_result =  mysqli_query($conn,$sqli_tiktokURL);
            if($tiktokURL_result){
                header('location:Editprofile.php');
            }
            else{
                $_SESSION['edit_follow'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
                header('location:Editprofile.php');
            }
        }

        //github
        if(!empty($_POST['github'])){
            $github = mysqli_real_escape_string($conn,$_POST['github']);
            $sqli_github = "UPDATE myprojace.follow SET github = '$github' WHERE follow_id = $foiiow_id";
            $github_result =  mysqli_query($conn,$sqli_github);
            if($github_result){
                header('location:Editprofile.php');
            }
            else{
                $_SESSION['edit_follow'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
                header('location:Editprofile.php');
            }
        }
        //githubURL
        if(!empty($_POST['githubURL'])){
            $githubURL = mysqli_real_escape_string($conn,$_POST['githubURL']);
            $sqli_githubURL = "UPDATE myprojace.follow SET githubURL = '$githubURL' WHERE follow_id = $foiiow_id";
            $githubURL_result =  mysqli_query($conn,$sqli_githubURL);
            if($githubURL_result){
                header('location:Editprofile.php');
            }
            else{
                $_SESSION['edit_follow'] = "เกิดข้อผิดผลาด โปรดลองใหม่ในภายหลัง";
                header('location:Editprofile.php');
            }
        }
}