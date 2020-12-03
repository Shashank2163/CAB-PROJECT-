<?php
session_start();
$username = $_SESSION['user_name'];
if (isset($_SESSION['is_user'])) {
    header("location:../cabnew/");
} else if (!isset($_SESSION['user_name'], $_SESSION['is_admin'])) {
    header("location:../login.php");
}
include('../ride.php');
include('header.php'); ?>

<body>
    <?php include("navigation.php") ?>
    <?php
    if (isset($_GET['ride_id'])) {
        $ride_id = $_GET['ride_id'];
        if ($_GET['action'] == 'remove') {
            $obj = new Ride();
            $db = new config();
            $result =  $obj->remove1($db->conn, $ride_id);
        } else if ($_GET['action'] == 'accept') {
            $obj = new Ride();
            $db = new config();
            $result =  $obj->accept($db->conn, $ride_id);
        } else if ($_GET['action'] == 'deny') {
            $obj = new Ride();
            $db = new config();
            $result =  $obj->cancel_ride($db->conn, $ride_id);
        }
    }
    ?>
    <select name="sort1" id="ride1" onchange="sortTable1(this.value,myTable)">
        <option value="" selected hidden disabled>SORT BY</option>
        <option value="0">Ride Id</option>
        <!-- <option value="4">Weight</option> -->
        <option value="5">Ride Fare</option>
    </select>
    <?php
    show1();
    function show1()
    {
        include('../src/config.php');
        $sql = "SELECT * FROM tbl_ride";
        $result = mysqli_query($conn, $sql);
    ?>
    <table id="myTable">
        <tr>
            <th>RIDE ID</th>
            <th>RIDE DATE</th>
            <th>FROM</th>
            <th>TO</th>
            <th>LUGGAGE</th>
            <th>TOTAL FARE</th>
            <th>BLOCK(0)/UNBLOCK(1)</th>
            <th>ACCEPT</th>
            <th>CANCEL</th>
            <th>ACTION</th>
        </tr>
        <?php $s = 0;
            $result = mysqli_query($conn, $sql);
            ?>
        <?php if (mysqli_num_rows($result) > 0) { ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['ride_id']; ?></td>
            <td><?php echo $row['ride_date']; ?></td>
            <td><?php echo $row['from_distance']; ?></td>
            <td><?php echo $row['to_distance']; ?></td>
            <td><?php echo $row['luggage'] ?></td>
            <td><?php echo $row['total_fare'] ?></td>
            <td><?php if ($row['status'] == 1) {
                                echo "SUCCESS";
                            } else if ($row['status'] == 2) {
                                echo "CANCEL";
                            } else {
                                echo "PENDING";
                            } ?></td>
            <td>
                <a class="btn-accept" href="rides.php?ride_id=<?php echo $row['ride_id']; ?>&action=accept" id="accept">
                    ACCEPT</a>
            </td>
            <td>
                <a href="rides.php?ride_id=<?php echo $row['ride_id']; ?>&action=deny" id="deny"
                    class="btn-deny">CANCEL</a>
            </td>
            <td><a class="btn-deny" href="rides.php?ride_id=<?php echo $row['ride_id']; ?>&action=remove" id="remove">
                    REMOVE </a>
            </td>
        </tr> <?php   } ?> <?php   } ?>
    </table> <?php  } ?>

</body>
<footer>
    <div class="container-fluid py-5">
        <div class="row">
            <div class=" col-md-4  col-sm-4 col-lg-4  col-xs-4 py-2 text-center"> <i
                    class="fab fa-facebook-f fa-lg white-text px-2"> </i> <i
                    class="fab fa-twitter fa-lg white-text px-2 "> </i> <i
                    class="fab fa-instagram fa-lg white-text px-2"> </i> </div>
            <div class=" col-md-4  col-sm-4  col-lg-4 col-xs-4 text-center">
                <h3 class="btn btn-warning">CED <span class="text-danger">CAB</span></h3>
            </div>
            <div class="col-md-4 col-sm-4  col-lg-4 col-xs-4 text-center">
                <div class="row py-2">
                    <div class="col-md-6 col-sm-6 col-lg-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</footer>

</html>