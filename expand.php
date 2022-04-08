<?php
require('session/check-session.php');
if(isset($_GET['username'])){
    $username = $_GET['username'];
}
?>

<html lang="">
<head>
    <title>Expand Page</title>
    <style>
        #data{
            font-family: "Arial Narrow";
            font-size: 40px;
            border: 2px solid grey;
            margin-top: 15px;
        }
        .list-item{
            font-size: 30px;
            margin-left: 10px;
            color: gray;
        }
    </style>
    <?php
    require ('htmlParts/commonCss.php');
    ?>

</head>
<body ng-app="myExpandApp" ng-controller="expand">
<h1>Expand page!</h1>
<a href="session/logout.php">
    <button class="btn btn-success" type="submit">Logout</button>
</a>

<div id="data">
    <ol style="list-style: none">
        <li>ID: <span class="list-item"> {{expand.id}}</span></li>
        <li>UserName: <span class="list-item"> {{expand.account.username}}</span></li>
        <li>FirstName: <span class="list-item">{{expand.account.firstName}}</span> </li>
        <li>LastName:  <span class="list-item"> {{expand.account.lastName}}</span></li>
        <li>Cell-Number:  <span class="list-item">{{cellHandler(expand.account.cellPhone)}}</span></li>
        <li>Account Created At: <span class="list-item">  {{ dateHandler(expand.account.accountCreated)}}</span></li>
        <li>Status is Active: <span class="list-item"> {{expand.account.isActive}}</span></li>
    </ol>
</div>


<?php
require ('htmlParts/commonJs.php');
?>

<script>

    var myExpandApp = angular.module("myExpandApp", []);

    myExpandApp.controller('expand', function ($scope){

        var settings = {
            "url": "https://backend-development.wbmyselfhealth.com/admin/getProvider/<?php echo $username; ?>",
            "method": "GET",
            "timeout": 0,
            "headers": {
                "Authorization": "Bearer <?php echo $jwt; ?>"
            },
        };
        $.ajax(settings).done(function (response) {
            $scope.expand = response;
            $scope.$apply();
            console.log(response);
        });

        $scope.dateHandler = function (value){
            //MM-DD-YYYY HH:MM:SS Z
            console.log(value);

            const d = new Date(value);
            //hours
            let hour = d.getHours();
            let z = hour > 12? "PM": "AM";
            //minutes
            let min = d.getMinutes();
            let minutes = min < 10? "0"+min: min;
            //seconds
            let sec = d.getSeconds();
            let seconds = sec < 10? "0"+sec: sec;
            //months
            let month = d.getMonth();
            let m = month < 10? "0"+month: month;
            //date
            let date = d.getDate();
            let day = date < 10? "0"+date : date;
            console.log(m);
            return m + "-" + day + "-" + d.getFullYear() + " " + hour + ":" +minutes+":"+ seconds +" " + z;
        }

        $scope.cellHandler = function (value){
            return value.slice(0,2) + "-" + value.slice(3,6) + "-" + value.slice(7,10) + "-" + value.slice(8,12);
        }
    });

</script>

</body>
</html>