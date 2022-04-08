<?php require("session/check-session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Main Page | Table Data</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">


    <?php
    require ('htmlParts/commonCss.php');
    ?>
</head>

<body ng-app="myModule" ng-controller="tableController">
<!-- {{2+3}} -->
   <a href="session/logout.php"><button type="submit">Logout</button></a>

<div>
    <table id="myTable" class="display" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>First-Name</th>
            <th>Last-Name</th>
            <th>Cell-Phone</th>
            <th>Account-Created On</th>
            <th> <strong>Status</strong>: is Active </th>
            <th>Expand</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="data in TableData">
            <td>{{ data.id }}</td>
            <td>{{ data.account.username }}</td>
            <td>{{ data.account.firstName }}</td>
            <td>{{data.account.lastName}}</td>
            <td>{{cellHandler(data.account.cellPhone)}}</td>
            <td>{{dateHandler(data.account.accountCreated)}}</td>
            <td>{{data.account.isActive}}</td>
            <td> <a href="expand.php?username={{ data.account.username }}"> <button style="cursor: pointer">Expand</button> </a> </td>
        </tr>
        </tbody>
    </table>
</div>
<?php
require ('htmlParts/commonJs.php');
?>
<!-- DatatableCDN -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    var myApp = angular.module("myModule", []);


    myApp.controller('tableController', function ($scope) {
        var settings = {
            "url": "https://backend-development.wbmyselfhealth.com/admin/getAllProviders",
            "method": "GET",
            "timeout": 0,
            "headers": {
                "Authorization": "Bearer <?php echo $jwt; ?>"
            },
        };
        $.ajax(settings).done(function (response) {
            $scope.TableData = response;
            $scope.$apply();
            $('#myTable').DataTable();
            console.log(response);
        });

        $scope.dateHandler = function(value){

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
            return m + "-" + day + "-" + d.getFullYear() + " " + hour + ":" + minutes +":"+ seconds +" " + z;
        }
            $scope.cellHandler = function (value){
                return value.slice(0,2) + "-" + value.slice(3,6) + "-" + value.slice(7,10) + "-" + value.slice(8,12);
            }

    });


</script>




</body>

</html>