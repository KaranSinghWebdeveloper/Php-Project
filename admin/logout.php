<?php
    include 'header.php';
    if(isset($_SESSION['email']) && isset($_SESSION['email'])){
    session_unset();
    session_destroy();
    header('Location: ../index.php');
    }else{
        header('Location: adminlogin.php');
        exit;
    }