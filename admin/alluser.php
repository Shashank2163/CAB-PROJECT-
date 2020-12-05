<?php
// $username = $_SESSION['user_name'];
session_start();
$username = $_SESSION['user_name'];
if (isset($_SESSION['is_user'])) {
    header("location:../cabnew/");
} else if (!isset($_SESSION['user_name'], $_SESSION['is_admin'])) {
    header("location:../login.php");
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    include('../user.php');
    if ($_GET['action'] == 'remove') {
        $db = new config();
        $obj = new User();
        $result =  $obj->remove_user($db->conn, $user_id);
    } else if ($_GET['action'] == 'accept') {
        $db = new config();
        $obj = new User();
        $result =  $obj->accept_user($db->conn, $user_id);
    } else if ($_GET['action'] == 'deny') {
        $db = new config();
        $obj = new User();
        $result = $obj->deny_user($db->conn, $user_id);
    }
    // show1($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CED CAB</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="filter.js"></script>
    <style>
    footer {
        padding: 15px;
        background-color: black;
        color: white;
        text-align: center;
    }

    #footer-text {
        color: white;
    }
    </style>
    <script>
    $(document).ready(function() {
        $("#btn").click(function() {
            var y = $("#ride").val();
            $.ajax({
                url: "../cabnew/ajax.php",
                method: "POST",
                data: {
                    y: y
                },
                success: function(msg) {
                    $("#main").html(msg);
                }
            });
        });
        y = 12
        $.ajax({
            url: "../cabnew/ajax.php",
            method: "POST",
            data: {
                y: y
            },
            success: function(msg) {
                $("#main").html(msg);
            }
        });

    });

    function myFunction() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        var y = $("#ride").val();
        $.ajax({
            url: "../cabnew/ajax.php",
            method: "POST",
            data: {
                filter: filter
            },
            success: function(msg) {
                $("#main").html(msg);
            }
        });

    }
    </script>
</head>

<body>
    <?php include("navigation.php") ?>
    <div id="ride1"> <select id="ride">
            <option value="12">
                ALL USERS
            </option>
            <option value="10">
                PENDING REQUESTS
            </option>
            <option value="11">
                APPROVED REQUESTS
            </option>
        </select>
        <input type="button" id="btn" value="PRESS">
        <select name="sort1" onchange="sortTable1(this.value,myTable)">
            <option value="" selected hidden disabled>SORT BY</option>
            <option value="0">User Id</option>
            <option value="4">MOBILE</option>
        </select>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
    </div>
    <div id="main"></div>
</body>
<footer>
    <p id="footer-text">Copyright@<span class="read-more">cedcoss</span>.com</p>
</footer>

</html>