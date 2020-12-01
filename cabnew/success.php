<?php
session_start();
$username = $_SESSION['user_name'];
if (!isset($_SESSION['user_name'])) {
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
        $date = date('Y-m-d H:i:s');
        $obj = new Ride();
        $db = new config();
        $obj->ridedetails($fare, $start, $end, $weight, $date, $user_id, $isblock, $db->conn);
    }
}
if (isset($_GET['action'], $_SESSION['user_id'])) {
    include('../ride.php');
    if ($_GET['action'] == 'pastride') {
        $user_id = $_SESSION['user_id'];
        $obj1 = new Ride();
        $db = new config();
        $result =  $obj1->rideinfo($db->conn, $user_id);
        $obj2 = new Ride();
        $db1 = new config();
        $result2 =  $obj1->total($db1->conn, $user_id);
        show($result, $result2);
    }
}
if (isset($_GET['action'], $_SESSION['user_id'])) {
    // include('../ride.php');
    if ($_GET['action'] == 'fare') {
        $user_id = $_SESSION['user_id'];
        $obj1 = new Ride();
        $db = new config();
        $result =  $obj1->sort_fare($db->conn, $user_id);
        $obj2 = new Ride();
        $db1 = new config();
        $result2 =  $obj1->total($db1->conn, $user_id);
        show($result, $result2);
    }
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
    <title>Hello, world!</title>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="cab.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4b2ee26aaa.js" crossorigin="anonymous"></script>
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
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (from_date != '' && to_date != '') {
                $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    data: {
                        from_date: from_date,
                        to_date: to_date
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
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light ">
            <h3 class="btn btn-warning">CED <span class="text-danger">CAB</span></h3>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span
                    class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mr-5"></ul>
                <form class="form-inline my-2 my-lg-0">
                    <a class="btn btn-warning mx-2" href="index.php">BOOK NOW</a>
                    <a class="btn btn-warning mx-2" href="success.php?&action=fare">SORT BY FARE </a>
                    <a class="btn btn-warning mx-2" href="success.php?&action=pastride">Past Ride</a>
                    <a class="btn btn-warning mx-2" href="success.php?&id=2">Filter</a>
                    <a class="btn btn-warning mx-2" href="../admin/invoice.php">Invoice</a>
                    <a class="btn btn-warning mx-2" href="logout.php">Log Out</a>
                    </h3>
                </form>
            </div>
        </nav>
    </div>

    <?php if (isset($_GET['id'])) {
        if ($_GET['id'] == 2) {
            echo '<div class="container py-5 my-5">
        <div class="row ml-5 px-4">
            <div class="col-md-3 col-sm-4">
                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
            </div>
            <div class="col-md-3  col-sm-4">
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
            </div>
            <div class="col-md-3  col-sm-4">
                <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
            </div>
        </div>
    </div>';
        }
    } ?>

    <div class="container-fluid" id="main">

    </div>
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
    <?php
    function show($result, $result2)
    {
        $total1 = 0;
        echo '<table>
            <tr>
                <th>USER ID</th>
                <th>RIDE DATE/TIME </th>
                <th>FROM</th>
                <th>TO</th>
                <th>DISTANCE</th>
                <th>WEIGHT</th>
                <th>STATUS</th>
                <th>FARE</th>
            </tr>';
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                <td>';
                echo $row['customer_user_id'];
                echo '</td>
                <td>';
                echo $row['ride_date'];
                echo   '</td>
                <td>';
                echo $row['from_distance'];
                echo '</td>
                <td>';
                echo $row['to_distance'];
                echo '</td>
                <td>';
                echo $row['total_distance'];
                echo '</td>
                <td>';
                echo $row['luggage'];
                echo '</td>
                <td>';
                if ($row['status'] == 0) {
                    echo 'PENDING';
                } else {
                    echo 'SUCCESS';
                    $total = $row['total_fare'];
                    $total1 = $total1 + $total;
                }
                echo '</td>
                <td>';
                echo $row['total_fare'];
                '</td>
            </tr>';
            }
            echo '<tr><td colspan="7">TOTAL SPEND</td><td>';
            echo $total1;
            echo '</td></tr>';
        }
    }
    echo '<table>';
    ?>

</body>

</html>