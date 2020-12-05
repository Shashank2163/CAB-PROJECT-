<?php
session_start();
$username = $_SESSION['user_name'];
if (!isset($_SESSION['user_name'], $_SESSION['is_user'])) {
    header("location:../login.php");
} else if (isset($_GET['id'])) {
    if ($_GET['id'] == 1) {
        include('../ride.php');
        $fare = $_SESSION['fare'];
        $start = $_SESSION['start'];
        $end = $_SESSION['end'];
        $weight = $_SESSION['weight'];
        $cab = $_SESSION['cab'];
        $user_id = $_SESSION['user_id'];
        $isblock = 0;
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
        $obj = new Ride();
        $db = new config();
        $obj->ridedetails($fare, $start, $end, $weight, $date, $user_id, $isblock, $db->conn);
    }
    unset($_SESSION['start'], $_SESSION['end'], $_SESSION['weight'], $_SESSION['cab'], $_SESSION['fare']);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>CED CAB</title>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="cab.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4b2ee26aaa.js" crossorigin="anonymous"></script>
    <style>
    footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: black;
        color: white;
        text-align: center;
        padding: 10px;


    }

    #footer-text {
        color: white;
    }

    /* body {
        /* height: 100%; */
    /* overflow: scroll;
    } */
    /* body {
        margin-bottom: 10px;
    } */

    #logo-btn {
        background-color: rgb(255 208 0);
        width: 100px;
        height: 38px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
    }

    #logo-span {
        color: red;
        padding-left: 7px;
    }

    #logo-p {
        margin: 6px;
    }
    </style>

</head>

<body>
    <div class="container-fluid pr-0 pl-0">
        <nav class="navbar navbar-expand-sm navbar-light bg-dark ">
            <p id="logo-p"><button id="logo-btn">CED<span id="logo-span">CAB</span></button></p>
            <!-- <h3 class="btn btn-warning">CED <span class="text-danger">CAB</span></h3> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span
                    class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mr-5"></ul>
                <form class="form-inline my-2 my-lg-0">
                    <a class="btn btn-warning mx-2" href="index.php">BOOK NOW</a>
                    <a class="btn btn-warning mx-2" href="user1.php">DASHBOARD</a>
                    <a class="btn btn-warning mx-2" href="logout.php">Log Out</a>
                    </h3>
                </form>
            </div>
        </nav>

        <?php
        if (isset($_GET['id'])) {
            if ($_GET['id'] == 1) {
                echo '<div class="placedorder text-center py-5 my-5">
        <h1>Your Request has Been Send Successfully !!!!</h1>
        <p>Thank you for riding with us, we will contact you by email with your ride details.</p>
    </div>';
            }
        }
        ?>


</body>
<footer>
    <p id="footer-text">Copyright@<span class="read-more">cedcoss</span>.com</p>
</footer>

</html>