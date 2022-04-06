<?php require("session/check-session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Main Page | Table Data</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">



</head>

<body ng-app="myModule" ng-controller="tableController">
<!-- {{2+3}} -->


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
            <td>{{ data.username }}</td>
            <td>{{ data.firstName }}</td>
            <td>{{data.lastName}}</td>
            <td>{{data.cellPhone}}</td>
            <td>{{data.accountCreated}}</td>
            <td>{{data.isActive}}</td>
            <td> <a target="_blank" href="expand.php/?id={{ data.id }}"> <button style="cursor: pointer">Expand</button> </a> </td>
        </tr>
        </tbody>
    </table>
</div>
<!-- Ajax  -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- DatatableCDN -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    var myApp = angular.module("myModule", []);


    myApp.controller('tableController', function ($scope) {
        var settings = {
            "url": "https://backend-development.wbmyselfhealth.com/test/getAllAccounts",
            "method": "GET",
            "timeout": 0,
        };
        $.ajax(settings).done(function (response) {
            $scope.TableData = response;
            $scope.$apply();
            $('#myTable').DataTable();
            console.log(response);




        });

    });


</script>




</body>

</html>