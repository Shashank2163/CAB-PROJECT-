<?php
// $username = $_SESSION['user_name'];
session_start();
if (!isset($_SESSION['user_name'])) {
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
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="style.css" rel="stylesheet">
    <script>
    $(document).ready(function() {
        $("#btn").click(function() {
            var y = $("#ride").val();
            // console.log(x);
            $.ajax({
                url: "../cabnew/ajax.php",
                method: "POST",
                data: {
                    y: y
                },
                success: function(msg) {

                    $(".main").html(msg);
                }
            });
        });

    });
    </script>
</head>

<body>
    <?php include("navigation.php") ?>
    <select id="ride">
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
    <div class="main"></div>

</body>

</html>