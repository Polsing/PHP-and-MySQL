<?php
session_start();
    unset($_SESSION['useraccount']);
    unset($_SESSION['userID']);

header('location: Index.php');

