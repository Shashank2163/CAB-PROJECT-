<?php
session_start();
$username = $_SESSION['user_name'];
if (isset($_SESSION['is_user'])) {
    header("location:../cabnew/");
} else if (!isset($_SESSION['user_name'], $_SESSION['is_admin'])) {
    header("location:../login.php");
}  ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>CED CAB</title>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="filter.js"></script>
    <script>
    $(document).ready(function() {
        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd'
        });
        $(function() {
            $("#from_date").datepicker();
            $("#to_date").datepicker();
        });
        $('#filter').click(function() {
            var fro_date = $('#from_date').val();
            var t_date = $('#to_date').val();
            if (from_date != '' && to_date != '') {
                $.ajax({
                    url: "../cabnew/ajax.php",
                    method: "POST",
                    data: {
                        fro_date: fro_date,
                        t_date: t_date
                    },
                    success: function(data) {
                        $('#main').html(data);
                    }
                });
            } else {
                alert("Please Select Date");
            }
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $("#btn").click(function() {
            var x = $("#ride").val();
            console.log(x);
            $.ajax({
                url: "../cabnew/ajax.php",
                method: "POST",
                data: {
                    x: x
                },
                success: function(msg) {
                    $("#main").html(msg);
                }
            });
        });
        x = 2;
        $.ajax({
            url: "../cabnew/ajax.php",
            method: "POST",
            data: {
                x: x
            },
            success: function(msg) {
                $("#main").html(msg);
            }
        });
    });
    </script>
</head>

<body>
    <?php include("navigation.php") ?>
    <div id="ride1"> <select id="ride">
            <option value="2">
                ALL RIDES
            </option>
            <option value="0">
                PENDING RIDES
            </option>
            <option value="3">
                CANCEL RIDES
            </option>
            <option value="1">
                SUCCESSFULL RIDES
            </option>

        </select>
        <input type="button" id="btn" value="PRESS">
        <select name="sort1" onchange="sortTable1(this.value,myTable)">
            <option value="" selected hidden disabled>SORT BY</option>
            <option value="5">Distance</option>
            <!-- <option value="6">Weight</option> -->
            <option value="7">Ride Fare</option>
        </select>
    </div>
    <div class="row px-5 px-5 pl-5 ml-5 text-center">
        <input type="text" class="col-2 " name="from_date" id="from_date" placeholder="From Date">
        <input type="text" class="col-2 ml-5" name="to_date" id="to_date" placeholder="To Date" />
        <input type="button" class="col-2 ml-5" class="btn btn-info" name="filter" id="filter" value="Filter" />
    </div>
    <div id="main"></div>
    <div id="main"></div>
</body>
<footer>
    <p id="footer-text">Copyright@<span class="read-more">cedcoss</span>.com</p>
</footer>

</html>