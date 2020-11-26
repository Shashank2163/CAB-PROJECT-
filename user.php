<?php
// session_start();
include('config.php');
class User
{
    public function login($user, $pass, $conn)
    {
        session_start();
        $x = true;
        $sql = "SELECT * FROM tbl_user";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($user == $row["user_name"] && $pass == $row["password"]) {
                    if ($row['is_admin'] == 2) {
                        $_SESSION['user_name'] = $row["user_name"];
                        $_SESSION['password'] = $row["password"];
                        header('location:admin/admin.php');
                    } else if ($row['isblock'] == 1) {
                        $_SESSION['user_name'] = $row["user_name"];
                        $_SESSION['password'] = $row["password"];
                        $_SESSION['status'] = $row["isblock"];
                        $_SESSION['user_id'] = $row["user_id"];
                        header('location:cabnew/index.php');
                        $x = true;
                    }
                }
            }
            if ($x) {
                echo  "Invalid Username Or Password";
            }
        }
    }
    public function signup($username, $name, $dateofsignup, $isblock, $isadmin, $password, $repassword, $mobile, $conn)
    {
        $sql = "SELECT * FROM tbl_user";
        $result = mysqli_query($conn, $sql);
        $x = true;
        $y = false;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($username == $row['user_name']) {
                    $x = false;
                    $y = true;
                }
            }
        }
        if ($y) {
            echo "*USERNAME ALREADY EXIST";
        }
        if ($password != $repassword) {
            echo "*PASSWORD IS NOT MATCHED";
        } else if ($x) {
            $password = md5($password);
            $sql = "INSERT INTO `tbl_user`( `user_name`, `name`, `dateofsignup`, `mobile`, `isblock`, `password`, `is_admin`) VALUES ('$username','$name','$dateofsignup','$mobile',$isblock,'$password',$isadmin)";
            if ($conn->query($sql) === true) {
                echo "SUCESSFULL REGISTER";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "HI! SOMETHING  WENT WRONG";
        }
    }
    public function update($name, $dateofsignup, $isblock, $isadmin, $password, $mobile, $conn)
    {
        $user_name = $_SESSION['user_name'];
        $sql = "UPDATE `tbl_user` SET `name`='$name',`dateofsignup`='$dateofsignup',`mobile`='$mobile',`isblock`=$isblock,`password`='$password',`is_admin`=$isadmin WHERE `user_name`='$user_name'";
        $result = mysqli_query($conn, $sql);
        return "Your Profile Successfully Updated!!!";
    }
    public function show($conn)
    {
        $user_name = $_SESSION['user_name'];
        $sql = "SELECT * FROM `tbl_user` where `user_name`='$user_name'";
        $result1 = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result1) > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                return $row1;
            }
        }
    }
    public function pending_user($conn)
    {

        $sql2 = "SELECT * FROM `tbl_user` WHERE  `isblock`=0";
        $result2 = mysqli_query($conn, $sql2);
        return $result2;
    }
    public function success_user($conn)
    {

        $sql2 = "SELECT * FROM `tbl_user` WHERE  `isblock`=1";
        $result2 = mysqli_query($conn, $sql2);
        return $result2;
    }
    public function all_user($conn)
    {
        $sql1 = "SELECT * FROM `tbl_user`";
        $result2 = mysqli_query($conn, $sql1);
        return $result2;
    }
}