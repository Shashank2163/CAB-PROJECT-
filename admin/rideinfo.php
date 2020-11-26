<?php
session_start();
$username = $_SESSION['user_name'];
// print_r($_SESSION);
if (!isset($_SESSION['user_name'])) {
    header("location:../login.php");
}
include('../ride.php');
if (isset($_GET['id'])) {
    if ($_GET['id'] == 2) {
        $obj1 = new Ride();
        $db = new config();
        $result = $obj1->ridein($db->conn);
        $obj2 = new Ride();
        $db1 = new config();
        $result2 =  $obj1->total1($db1->conn);
        show($result, $result2);
        // show($result);
    }
}
if (isset($_GET['user_id'])) {
    if ($_GET['action'] == 'remove') {
        $obj = new Ride();
        $db = new config();
        $user_id = $_GET['user_id'];
        $result1 = $obj->remove($db->conn, $user_id);
        $obj1 = new Ride();
        $db1 = new config();
        $result = $obj1->ridein($db1->conn);
        $obj2 = new Ride();
        $db1 = new config();
        $result2 =  $obj1->total1($db1->conn);
        show($result, $result2);
        // show($result);
    }
}
?>
<?php include('header.php'); ?>
<?php include('navigation.php') ?>
<?php

function show($result, $result2)
{
    $total = 0;

    echo '<table>
        <tr>
            <th>USER ID</th>
            <th>RIDE DATE/TIME </th>
            <th>FROM</th>
            <th>TO</th>
            <th>DISTANCE</th>
            <th>WEIGHT</th>
            <th>FARE</th>
            <th>ACTION</th>
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
            echo $total = $row['total_fare'];
            $total += $total;
            echo '</td>
        <td>';
            echo '<a class="btn-deny" href="rideinfo.php?user_id=' . $row['customer_user_id'] . '&action=remove"
id="remove">REMOVE</a>';
            echo '</td>
</tr>';
        }
    }
    echo '<tr><td colspan="7">TOTAL EARNING</td><td>';
    echo  $result2;
    echo '</td></tr>';
} ?>
</table>
</body>

</html>