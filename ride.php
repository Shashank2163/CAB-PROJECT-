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
        $sql = "SELECT SUM(total_fare) FROM tbl_ride";
        $result2 = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result2) > 0) {
            while ($row1 = mysqli_fetch_assoc($result2)) {
                return $row1['SUM(total_fare)'];
            }
        }
    }
    public function remove($conn, $user_id)
    {
        $sql = "DELETE FROM `tbl_ride` WHERE `customer_user_id`=$user_id";
        $result = mysqli_query($conn, $sql);
    }
    public function remove1($conn, $ride_id)
    {
        $sql = "DELETE FROM `tbl_ride` WHERE `ride_id`=$ride_id";
        $result = mysqli_query($conn, $sql);
    }
    public function accept($conn, $ride_id)
    {
        $sql1 = "UPDATE  `tbl_ride` SET `status`=1 WHERE `ride_id`=$ride_id";
        $result1 = mysqli_query($conn, $sql1);
    }
    public function deny($conn, $ride_id)
    {

        $sql2 = "UPDATE  `tbl_ride` SET `status`=0 WHERE `ride_id`=$ride_id";
        $result2 = mysqli_query($conn, $sql2);
    }
    public function pending($conn)
    {

        $sql2 = "SELECT * FROM `tbl_ride` WHERE  `status`=0";
        $result2 = mysqli_query($conn, $sql2);
        return $result2;
    }
    public function success($conn)
    {
        $sql2 = "SELECT * FROM `tbl_ride` WHERE  `status`=1";
        $result2 = mysqli_query($conn, $sql2);
        return $result2;
    }
    public function allrides($conn)
    {
        $sql1 = "SELECT * FROM `tbl_ride`";
        $result2 = mysqli_query($conn, $sql1);
        return $result2;
    }

    public function insertloc($conn, $loc_name, $distance, $avail)
    {
        $sql = "INSERT INTO `tbl_location`(`name`, `distance`, `is_available`) VALUES ('$loc_name','$distance',$avail)";
        $result = mysqli_query($conn, $sql);
    }
    public function alllocation($conn)
    {
        $sql1 = "SELECT * FROM `tbl_location`";
        $result2 = mysqli_query($conn, $sql1);
        return $result2;
    }
    public function alllocation1($conn)
    {
        $sql1 = "SELECT `name` FROM `tbl_location` where is_available=1";
        $result2 = mysqli_query($conn, $sql1);
        return $result2;
    }
    public function allow_location($conn, $id)
    {
        $sql = "UPDATE `tbl_location` SET `is_available`=1 WHERE `id`=$id";
        $result2 = mysqli_query($conn, $sql);
        return $result2;
    }
    public function deny_location($conn, $id)
    {
        $sql = "UPDATE `tbl_location` SET `is_available`=0 WHERE `id`=$id";
        $result2 = mysqli_query($conn, $sql);
        return $result2;
    }
    public function sort_fare($conn, $user_id)
    {
        $sql1 = "SELECT * FROM `tbl_ride` where `customer_user_id`=$user_id ORDER BY `total_fare` DESC";
        $result2 = mysqli_query($conn, $sql1);
        return $result2;
    }
}