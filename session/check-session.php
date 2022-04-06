<?php
session_start();
if(isset($_REQUEST['auth_token']))
{
    $jwt = $_REQUEST['auth_token'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://backend-development.wbmyselfhealth.com/admin/details",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $jwt"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $jsonResponse=json_decode($response);


    $userRole=$jsonResponse->account->roles[0];
    $userEmail=$jsonResponse->account->username;
    $userName=$jsonResponse->firstName." ".$jsonResponse->lastName;

    $_SESSION["jwt"]=$jwt;
    $_SESSION["role"]=$userRole;
    $_SESSION["email"]=$userEmail;
    $_SESSION["name"]=$userName;
    session_commit();
}

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


?>