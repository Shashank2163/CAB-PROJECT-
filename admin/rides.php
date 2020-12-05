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
        <option value="6">Ride Fare</option>
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
            <th colspan="10">
                <center>
                    <h3>ALL RIDE REQUEST</h3>
                </center>
            </th>
        </tr>
        <tr>
            <th>RIDE ID</th>
            <th>RIDE DATE</th>
            <th>FROM</th>
            <th>TO</th>
            <th>LUGGAGE (K.G.)</th>
            <th>TOTAL FARE (₹)</th>
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
                                echo "<span class='blink-two'>PENDING</span>";
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
    <p id="footer-text">Copyright@<span class="read-more">cedcoss</span>.com</p>
</footer>

</html>