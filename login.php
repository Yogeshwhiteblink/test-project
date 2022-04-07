<?php
session_start();
if(isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

?>

<html>
<head>
    <title>
        Login
    </title>
    <?php
    require ('htmlParts/commonCss.php');
    ?>
</head>

<body ng-app="myApp" ng-controller="formController">
<div class="card">
    <div class="card-header">
        Log In
    </div>
    <div class="card-body">
<form name="loginForm">
    Email: <input type="email" ng-model="email" ng-required="true">
    <span style="color: red">
        <span ng-show="loginForm.email.$error.required">Email is Required</span>
        <span ng-show="loginForm.email.$error.email">Invalid email address</span>
    </span>
    Password: <input type="password" ng-model="password" ng-required="true" ng-minlength="8">
    <span style="color: red">
        <span ng-show="loginForm.password.$error.required">Password is Required</span>
        <span ng-show="loginForm.password.$error.minlength">Password length must be of minimun 8 char</span>

    </span>
    <button class="btn btn-success" type="submit" ng-disabled="loginForm.email.$invalid || loginForm.password.$invalid" ng-click="submit()" >login</button>
</form>
    </div>
</div>
<div class="card">
    <img class="card-img-top img-fluid" src="../assets/assets/images/big/img1.jpg" alt="Card image cap">
    <div class="card-body">
        <h4 class="card-title">Card title</h4>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
    </div>
</div>




<?php
require ('htmlParts/commonJs.php');
?>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
     var app = angular.module("myApp", []);

     app.controller("formController", function($scope){
         $scope.submit = function (){
             var settings = {
                 "url": "https://backend-development.wbmyselfhealth.com/authenticate",
                 "method": "POST",
                 "timeout": 0,
                 "headers": {
                     "Content-Type": "application/json"
                 },
                 "data": JSON.stringify({
                     "password": "password",
                     "username": "admin1@whiteblink.com"
                 }),
             };

             $.ajax(settings).done(function (response) {
                 console.log(response);
                 var settings2 = {
                     "url": "session/setSession.php",
                     "method": "POST",
                     "timeout": 0,
                     "headers": {
                         "Content-Type": "application/json"
                     },
                     "data": response.jwt
                 };

                 $.ajax(settings2).done(function (response) {
                     console.log(response);
                    window.location.href="index.php"
                 });
             });
         }



     })
</script>
</body>
</html>