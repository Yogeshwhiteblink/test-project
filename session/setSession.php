<?php
session_start();
$jwt = file_get_contents('php://input');
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://backend-development.wbmyselfhealth.com/account/details",
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
$_SESSION['id'] = $jsonResponse->id;
$_SESSION['username'] = $jsonResponse->username;
$_SESSION['role'] = $jsonResponse->roles[0];
$_SESSION['firstName'] = $jsonResponse->firstName;
$_SESSION['lastName'] = $jsonResponse->lastName;
$_SESSION['jwt'] = $jwt;

session_commit();
echo  "true";

?>


