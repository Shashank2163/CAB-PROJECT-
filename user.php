<?php
// session_start();
include('config.php');
class User
{   /* FUNCTION FOR LOGIN USER */
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
                        $_SESSION['is_admin'] = 2;
                        header('location:admin/');
                    } else if ($row['isblock'] == 1) {
                        $_SESSION['user_name'] = $row["user_name"];
                        $_SESSION['password'] = $row["password"];
                        $_SESSION['status'] = $row["isblock"];
                        $_SESSION['user_id'] = $row["user_id"];
                        $_SESSION['is_user'] = 1;
                        if (isset($_SESSION['fare'])) {
                            header('location:cabnew/success.php?id=1');
                        } else {
                            header('location:cabnew/index.php');
                        }
                        $x = true;
                    }
                }
            }
            if ($x) {
                echo  "<script>alert('Invalid Username Or Password');</script>";
            }
        }
    }
    /* FUNCTION FOR SIGNUP USER */
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
            echo "<script>alert('Username already Exist');</script>";
        }
        if ($password != $repassword) {
            echo '<script>alert("PASSWORD IS NOT MATCHED");</script>';
        } else if ($x) {
            $password = md5($password);
            $sql = "INSERT INTO `tbl_user`( `user_name`, `name`, `dateofsignup`, `mobile`, `isblock`, `password`, `is_admin`) VALUES ('$username','$name','$dateofsignup','$mobile',$isblock,'$password',$isadmin)";
            if ($conn->query($sql) === true) {
                echo "<script>alert('SUCCESSFULLY REGISTERED ');window.location.href='login.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // echo "HI! SOMETHING  WENT WRONG";
        }
    }
    public function update($name, $username, $mobile, $conn)
    {
        // $user_name = $_SESSION['user_name'];
        $user_id = $_SESSION['user_id'];
        $sql = "UPDATE `tbl_user` SET `user_name`='$username' ,`name`='$name' ,`mobile`='$mobile' WHERE `user_id`='$user_id'";
        // echo $sql;
        $result = mysqli_query($conn, $sql);
        return $result;
    }
    public function update_password($password, $repassword, $conn)
    {
        $user_name = $_SESSION['user_name'];
        $sql = "SELECT * from `tbl_user` where `password`='$password'";
        $result = $conn->query($sql);

        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE `tbl_user` SET `password`='$repassword'  where `user_name`='$user_name' AND `password`='$password'";
            if ($conn->query($sql) === true) {
                session_destroy();
                echo "<script>alert('SUCCESSFULLY UPDATED');window.location.href='../login.php';</script>";
                // header('location:../login.php');
            }
        } else {
            echo '<script>alert("Your Old Password is Wrong")</script>';
        }
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
    public function remove_user($conn, $user_id)
    {
        $sql = "DELETE FROM `tbl_user` WHERE `user_id`=$user_id";
        // echo $sql;
        $result = mysqli_query($conn, $sql);
    }
    public function accept_user($conn, $user_id)
    {
        $sql1 = "UPDATE  tbl_user SET isblock=1 WHERE `user_id`=$user_id";
        $result = mysqli_query($conn, $sql1);
    }
    public function deny_user($conn, $user_id)
    {
        $sql2 = "UPDATE  tbl_user SET isblock=0 WHERE `user_id`=$user_id";
        $result = mysqli_query($conn, $sql2);
    }
    public function search_user($conn, $filter)
    {
        $a = $filter;
        $sql1 = "SELECT * FROM `tbl_user`
        WHERE user_name LIKE '$a%' ";
        // echo $sql1;
        $result = mysqli_query($conn, $sql1);
        return ($result);
    }
}