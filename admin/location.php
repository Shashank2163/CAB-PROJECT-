<?php
session_start();
$username = $_SESSION['user_name'];
if (isset($_SESSION['is_user'])) {
    header("location:../cabnew/");
} else if (!isset($_SESSION['user_name'], $_SESSION['is_admin'])) {
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
        if ($_GET['action'] == 'remove') {
            include('../ride.php');
            $db1 = new config();
            $obj = new Ride();
            $result = $obj->remove_location($db1->conn, $id);
            echo '<script>alert("REMOVE SUCESSFULL")</script>';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CED CAB</title>
    <link href="style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="filter.js"></script>
    <style>
    footer {
        padding: 15px;
        background-color: black;
        color: white;
        text-align: center;
        position: fixed;
        width: 100%;
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;

    }

    #footer-text {
        color: white;
    }

    body {
        height: 100%;
    }
    </style>
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
                    alert("Your Location Is Added");
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
                    $("#main").html(msg);
                    // '<a href="location.php" id="btn">BACK</a></br>'
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
                    <input type="text" id="location_name" name="location_name" placeholder="Location Name.."
                        pattern="[^(?![0-9]*$)[a-zA-Z0-9]+$]" required>
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
<footer>
    <p id="footer-text">Copyright@<span class="read-more">cedcoss</span>.com</p>
</footer>

</html>