<?php
session_start();

if(!isset($_SESSION['jwt'])){
    header('Location: login.php');
    exit;
}

if(isset($_SESSION['role']))
{
    if($_SESSION['role']!="ROLE_ADMIN")
    {
        session_destroy();
        session_commit();
        header('Location: login.php');
        exit;
    }
}else{
    session_destroy();
    session_commit();
    header('Location: login.php');
    exit;
}

$jwt=$_SESSION['jwt'];



