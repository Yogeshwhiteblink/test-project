<html>
<head>
    <title>
        Login
    </title>
</head>

<body ng-app="myApp" ng-controller="formController">
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
    <button type="submit" ng-disabled="loginForm.email.$invalid || loginForm.password.$invalid" ng-click="submit()" >login</button>
</form>




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