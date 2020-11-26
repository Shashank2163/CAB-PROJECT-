<?php
include('config.php');
class Ride
{
    public function ridedetails($fare, $start, $end, $weight, $date, $user_id, $isblock, $conn)
    {
        $distance = $_SESSION['distance'];
        $sql1 = "INSERT INTO `tbl_ride`( `ride_date`, `from_distance`, `to_distance`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`) 
        VALUES ('$date','$start','$end','$distance','$weight','$fare',$isblock,$user_id)";
        $result = mysqli_query($conn, $sql1);
    }
    public function rideinfo($conn, $user_id)
    {
        $sql1 = "SELECT * FROM `tbl_ride` WHERE customer_user_id=$user_id";
        $result = mysqli_query($conn, $sql1);
        return $result;
    }
    public function ridein($conn)
    {
        $sql1 = "SELECT * FROM `tbl_ride`";
        $result = mysqli_query($conn, $sql1);
        return $result;
    }
    public function remove($conn, $user_id)
    {
        $sql = "DELETE FROM `tbl_ride` WHERE `customer_user_id`=$user_id";
        $result = mysqli_query($conn, $sql);
    }
    public function total($conn, $user_id)
    {
        $sql = "SELECT SUM(total_fare)             
        FROM tbl_ride where `customer_user_id`=$user_id";
        $result2 = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result2) > 0) {
            while ($row1 = mysqli_fetch_assoc($result2)) {
                return $row1['SUM(total_fare)'];
            }
        }
    }
    public function total1($conn)
    {
        $sql = "SELECT SUM(total_fare)             
        FROM tbl_ride";
        $result2 = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result2) > 0) {
            while ($row1 = mysqli_fetch_assoc($result2)) {
                return $row1['SUM(total_fare)'];
            }
        }
    }
}