<?php
session_start();
$username = $_SESSION['user_name'];
if (!isset($_SESSION['user_name'])) {
    header("location:../login.php");
}
include('navigation.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'accept') {
            include('../ride.php');
            $db1 = new config();
            $obj = new Ride();
            $result = $obj->allow_location($db1->conn, $id);
            echo '<script>alert("ALLOW SUCESSFULL")</script>';
        }

        if ($_GET['action'] == 'deny') {
            include('../ride.php');
            $db1 = new config();
            $obj = new Ride();
            $result = $obj->deny_location($db1->conn, $id);
            echo '<script>alert("DENY SUCESSFULL")</script>';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="filter.js"></script>
    <script>
    $(document).ready(function() {
        $("#btn-9").click(function() {
            var loc_name = $("#location_name").val();
            var distance = $("#distance").val();
            var avail = $("#avail").val();
            if (distance == "" || loc_name == "") {
                return alert("PLEASE FIELD VALUE");
            }
            $.ajax({
                url: "../cabnew/ajax.php",
                method: "POST",
                data: {
                    loc_name: loc_name,
                    distance: distance,
                    avail: avail
                },
                success: function(msg) {
                    alert("Your Location IS Added");
                }
            });
        });



        $("#btn-2").click(function() {
            $(".container5").hide();
            $("#btn-2").hide();
            $.ajax({
                url: "../cabnew/ajax.php",
                method: "POST",
                data: {
                    dat: 5
                },
                success: function(msg) {
                    $("#btn").show();
                    $("#main").html(msg + '</br><a href="location.php" id="btn">BACK</a>');
                    // $("#btn").show();

                }
            });

        });
    });
    </script>
</head>

<body>
    <input type="button" id="btn-2" value="CLICK HERE TO SHOW LOCATION  LIST">
    <div class="container5">
        <form action="">
            <div class="row">
                <div class="col-25">
                    <label for="locname">LOCATION NAME</label>
                </div>
                <div class="col-75">
                    <input type="text" id="location_name" name="location_name" placeholder="Location Name.." required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="distance">DISTANCE</label>
                </div>
                <div class="col-75">
                    <input type="number" id="distance" id="distance" placeholder="Distance.." required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="available">AVAILABLE</label>
                </div>
                <div class="col-75">
                    <select id="avail" name="available">
                        <option value="1">Allow</option>
                        <option value="0">Block</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <input type="button" value="Submit" id="btn-9">
            </div>
        </form>

    </div>
    <div id="main">

    </div>
</body>

</html>