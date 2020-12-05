<?php
session_start();
$username = $_SESSION['user_name'];
if (!isset($_SESSION['user_name'], $_SESSION['is_user'])) {
    header("location:../login.php");
}
if (isset($_GET['action'], $_SESSION['user_id'])) {
    include('../ride.php');
    if ($_GET['action'] == 'pastride') {
        $user_id = $_SESSION['user_id'];
        $obj1 = new Ride();
        $db = new config();
        $result = $obj1->rideinfo($db->conn, $user_id);
        $obj2 = new Ride();
        $db1 = new config();
        $result2 = $obj1->total($db1->conn, $user_id);
        $message = "YOUR PAST RIDES WITH CAB";
        show($result, $result2, $message);
    } else if ($_GET['action'] == 'allrides') {
        $user_id = $_SESSION['user_id'];
        $obj1 = new Ride();
        $db = new config();
        $result = $obj1->countride2($db->conn, $user_id);
        $obj2 = new Ride();
        $db1 = new config();
        $result2 = $obj1->total($db1->conn, $user_id);
        $message = "YOUR ALL RIDES WITH CAB";
        show($result, $result2, $message);
    } else if ($_GET['action'] == 'pending') {
        $user_id = $_SESSION['user_id'];
        $obj1 = new Ride();
        $db = new config();
        $result = $obj1->pcountride2($db->conn, $user_id);
        $obj2 = new Ride();
        $db1 = new config();
        $result2 = $obj1->total($db1->conn, $user_id);
        $message = "YOUR PENDING RIDES WITH CAB";
        show($result, $result2, $message);
    } else if ($_GET['action'] == 'completed') {
        $user_id = $_SESSION['user_id'];
        $obj1 = new Ride();
        $db = new config();
        $result = $obj1->cocountride2($db->conn, $user_id);
        $obj2 = new Ride();
        $db1 = new config();
        $result2 = $obj1->total($db1->conn, $user_id);
        $message = "YOUR COMPLETED RIDES WITH CAB";
        show($result, $result2, $message);
    } else if ($_GET['action'] == 'cancel') {
        $user_id = $_SESSION['user_id'];
        $obj1 = new Ride();
        $db = new config();
        $result = $obj1->cancelride6($db->conn, $user_id);
        $obj2 = new Ride();
        $db1 = new config();
        $result2 = $obj1->total($db1->conn, $user_id);
        $message = "YOUR CACEL RIDES WITH CAB";
        show($result, $result2, $message);
    } else if ($_GET['action'] == 'deny') {
        $ride_id = $_GET['ride_id'];
        $obj = new Ride();
        $db = new config();
        $result =  $obj->cancel_ride($db->conn, $ride_id);
    }
}
if (isset($_GET['action'], $_SESSION['user_id'])) {
    // include('../ride.php');
    if ($_GET['action'] == 'fare') {
        $user_id = $_SESSION['user_id'];
        $obj1 = new Ride();
        $db = new config();
        $result = $obj1->sort_fare($db->conn, $user_id);
        $obj2 = new Ride();
        $db1 = new config();
        $result2 = $obj1->total($db1->conn, $user_id);
        $message = "YOUR FARE SPEND ON CAB";
        show($result, $result2, $message);
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

    .blink-two {
        animation: blinker-two 1.4s linear infinite;
        color: red
    }

    @keyframes blinker-two {
        100% {
            opacity: 0;
        }
    }
    </style>
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
                    <a class="btn btn-warning mx-2" href="profile.php">EDIT PROFILE</a>
                    <a class="btn btn-warning mx-2" href="user1.php">DASHBOARD</a>
                    <a class="btn btn-warning mx-2" href="logout.php">Log Out</a>
                    </h3>
                </form>
            </div>
        </nav>
        <a class="btn btn-success mx-2 my-3" href="dashboard1.php?&action=allrides">ALL RIDES </a>
        <a class="btn btn-success mx-2 my-3" href="dashboard1.php?&action=pending">PENDING RIDES</a>
        <a class="btn btn-success mx-2 my-3" href="dashboard1.php?&action=cancel">CANCEL RIDES</a>
        <a class="btn btn-success mx-2 my-3" href="dashboard1.php?&action=completed">COMPLETED RIDES</a>
        <a class="btn btn-primary mx-2 my-3 float-right" href="dashboard1.php?&action=fare">SORT BY FARE </a>
        <a class="btn btn-primary mx-2 my-3  float-right" href="dashboard1.php?&action=pastride">Past Ride</a>
        <a class="btn btn-primary mx-2 my-3  float-right" href="dashboard1.php?&id=2">Filter</a>
        <!-- <a class="btn btn-success mx-2" href="../admin/invoice.php">Invoice</a> -->
    </div>

    <?php if (isset($_GET['id'])) {
        if ($_GET['id'] == 2) {
            echo '<div class="container">
            <h1>ALL RIDES BETWEEN TWO DATES</h1>
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
    function show($result, $result2, $message)
    {

        $total1 = 0;
        echo '<table>
            <tr>';
        echo  '<th colspan="10"><h3>' . $message . "</h3></th></tr>";
        echo  '<tr><th>USER ID</th>
                <th>RIDE DATE/TIME </th>
                <th>FROM</th>
                <th>TO</th>
                <th>DISTANCE(K.M.)</th>
                <th>WEIGHT(K.G.)</th>
                <th>STATUS</th>
                <th>ACTION</th>
                <th>FARE (₹)</th>
                <th>INVOICE</th>
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
                    echo "<span class='blink-two'>PENDING</span>";
                } else if ($row['status'] == 2) {
                    echo "<span>CANCEL</span>";
                } else if ($row['status'] == 1) {
                    echo 'SUCCESS';
                    $total = $row['total_fare'];
                    $total1 = $total1 + $total;
                }
                echo '</td>
                <td>';
                if ($row['status'] == 0) {
                    echo  '<a href="dashboard1.php?ride_id=' . $row['ride_id'] . '&action=deny" id="deny"
    class="btn-deny">CANCEL</a>';
                } else if ($row['status'] == 2) {
                    echo "<span>N/A</span>";
                } else if ($row['status'] == 1) {
                    echo "<span>N/A</span>";
                }
                echo '</td>
    <td>';
                echo $row['total_fare'];
                echo '</td><td>';
                if ($row['status'] == 0) {
                    echo  'N/A';
                } else if ($row['status'] == 2) {
                    echo "<span>N/A</span>";
                } else if ($row['status'] == 1) {
                    echo '<a href="../admin/invoice.php?user_id=' . $row["ride_id"] . '&action=invoice" id="btn-3">INVOICE</a>';
                }
                echo   '</td></tr>';
            }
            echo '<tr>
        <td colspan="9">TOTAL SPEND</td>
        <td>';
            echo "₹" . $total1;
            echo '</td>
    </tr>';
        }
    }
    echo '<table>';
    ?>

</body>
<footer>
    <p id="footer-text">Copyright@<span class="read-more">cedcoss</span>.com</p>
</footer>

</html>